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
        if (Auth::check()) {
            return redirect("/");
        }

        return view('auth.login');
    }

    public function showSignupForm()
    {
        if (Auth::check()) {
            return redirect("/");
        }
        return view('auth.signup');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot');
    }

    public function showResetPasswordForm()
    {
        return view('auth.reset');
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
                if ($user->status === User::STATUS_INACTIVE) {

                    return back()->withErrors([
                        'error' => 'Your account is inactive.',
                    ]);
                }

                if ($user->status === User::STATUS_PENDING) {
                    return back()->withErrors([
                        'error' => 'Your account is pending approval.',
                    ]);
                }
            }

            if (Auth::attempt($credentials)) {

                $request->session()->regenerate();

                if (Auth::user()->hasRole('admin')) {
                    return redirect()->intended('/dashboard');
                } else {
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
            $user = $this->userRepository->manageUser($request);

            if ($user == 201) {
                return redirect()->route('login')->with('success', 'Account created successfully');
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
    public function sendPasswordResetLink()
    {
    }
    public function resetPassword()
    {
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
