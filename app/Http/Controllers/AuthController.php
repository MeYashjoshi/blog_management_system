<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\AuthRepositoryInterface;

class AuthController extends Controller
{
    public function __construct(
        private AuthRepositoryInterface $AuthRepository
    ) {}

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

   public function showResetPasswordForm()
    {
        return view('auth.reset');
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
