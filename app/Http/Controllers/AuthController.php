<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
   public function showLoginForm()
    {
        return view('Auth.login');
    }

   public function showSignupForm()
    {
        return view('Auth.signup');
    }

   public function showForgotPasswordForm()
    {
        return view('Auth.forgot');
    }

   public function showResetPasswordForm()
    {
        return view('Auth.reset');
    }

   public function login()
    {
    }

   public function signup()
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

    public function logout()
    {
    }
}
