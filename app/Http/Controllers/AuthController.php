<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // public function __construct(
    //     private AuthRepositoryInterface $AuthRepository
    // ) {}

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
            return redirect()->intended('/');
        }


        return redirect("login")->withError('Opps! You have entered invalid credentials');

    }

   public function signup(Request $request)
    {

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
