<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showSignupForm()
    {
        return view('auth.signup');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot');
    }

    public function showResetPasswordForm($token, $email = null)
    {
        return view('auth.reset', ['token' => $token, 'email' => $email]);
    }

    public function login(Request $request)
    {
        try {

            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = User::where('email', $credentials['email'])->first();



            if ($user) {
                if ($user->status === User::STATUS_PENDING && $user->hasVerifiedEmail()) {
                    return back()->withErrors([
                        'error' => 'Your account is pending approval.',
                    ]);
                }

                if (!$user->hasVerifiedEmail()) {
                    if (\Hash::check($credentials['password'], $user->password)) {
                        $request->session()->put('verify_email', $user->email);
                        return redirect()->route('verification.notice');
                    }
                }
            }

            if (Auth::attempt($credentials)) {

                $request->session()->regenerate();

                // If somehow unverified user gets logged in (e.g. via remember me), handle it.
                if (!Auth::user()->hasVerifiedEmail()) {
                    Auth::logout();
                    $request->session()->put('verify_email', $user->email);
                    return redirect()->route('verification.notice');
                }



                if (Auth::user()->hasRole('admin')) {
                    $request->session()->regenerate();
                    return redirect()->intended('/dashboard');
                } else {
                    $request->session()->regenerate();
                    return redirect()->intended('/');
                }
            } else {
                return back()->withErrors([
                    'error' => 'Opps! You have entered invalid credentials',
                ]);
            }
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function signup(StoreUserRequest $request)
    {

        try {
            $existingUser = User::where('email', $request->email)->first();

            if ($existingUser) {
                if ($existingUser->hasVerifiedEmail()) {
                    return back()->withErrors(['email' => 'This email is already in use.'])->withInput();
                } else {
                    $request->session()->put('verify_email', $existingUser->email);
                    return redirect()->route('verification.notice')->with('error', 'Account already exists. Please verify your email.');
                }
            }

            $user = $this->userRepository->manageUser($request);

            if ($user instanceof User) {
                event(new \Illuminate\Auth\Events\Registered($user));
                Auth::login($user);
                return redirect()->route('verification.notice')->with('success', 'Account created successfully. Please verify your email.');
            } elseif ($user == 409) {
                return redirect()->route('login')->with('error', 'Account already exists');
            } else {
                return redirect()->route('login')->with('error', 'Account creation failed');
            }

        } catch (\Throwable $e) {
            dd($e);
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function showVerificationNotice(Request $request)
    {
        if (Auth::check() && Auth::user()->hasVerifiedEmail()) {
            return redirect()->intended('/');
        }

        if (!Auth::check() && !$request->session()->has('verify_email')) {
            return redirect()->route('login');
        }

        return view('auth.verify-email');
    }

    public function verifyEmail(Request $request)
    {
        try {
            $user = User::findOrFail($request->route('id'));

            if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
                throw new \Exception('Invalid verification link.');
            }

            if ($user->hasVerifiedEmail()) {
                return redirect()->intended('/')->with('success', 'Email already verified!');
            }

            if ($user->markEmailAsVerified()) {
                $user->status = User::STATUS_ACTIVE;
                $user->save();
                event(new \Illuminate\Auth\Events\Verified($user));
            }

            return redirect()->route('login.page')->with('success', 'Email Verified Successfully! Please login.');

        } catch (\Throwable $e) {
            return redirect()->route('login.page')->with('error', $e->getMessage());
        }
    }

    public function resendVerificationEmail(Request $request)
    {
        try {
            if (Auth::check() && $request->user()->hasVerifiedEmail()) {
                return redirect()->intended('/');
            }

            $email = $request->session()->get('verify_email');

            if (!$email && Auth::check()) {
                $email = Auth::user()->email;
            }

            if (!$email) {
                return redirect()->route('login')->with('error', 'Session expired. Please login again.');
            }

            $user = User::where('email', $email)->first();

            if ($user && !$user->hasVerifiedEmail()) {
                $user->sendEmailVerificationNotification();
                return back()->with('success', 'Verification link sent!');
            }

            return back()->with('success', 'If an account exists, a verification link has been sent.');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function sendPasswordResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        try {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return back()->with('error', 'We cannot find a user with that email address.');
            }

            $token = \Str::random(60);

            \DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $request->email],
                [
                    'email' => $request->email,
                    'token' => $token, // Ideally hash this token, but for now storing plain as requested logic "like mine"
                    'created_at' => now()
                ]
            );

            \Mail::to($request->email)->send(new \App\Mail\ResetPasswordMail($token, $request->email));

            return back()->with('success', 'We have e-mailed your password reset link!');

        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:150',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).+$/',
            ],
        ]);

        try {
            $resetRecord = \DB::table('password_reset_tokens')->where('email', $request->email)->first();

            if (!$resetRecord || $resetRecord->token !== $request->token) {
                return back()->with('error', 'Invalid token or email.');
            }

            // Optional: Check expiration (e.g., 60 minutes)
            // if (Carbon::parse($resetRecord->created_at)->addMinutes(60)->isPast()) { ... }

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return back()->with('error', 'We cannot find a user with that email address.');
            }

            $user->password = \Hash::make($request->password);
            $user->save();

            \DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            return redirect()->route('login.page')->with('success', 'Your password has been reset!');

        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function getUserStatus()
    {
    }
    public function getUserRole()
    {
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
