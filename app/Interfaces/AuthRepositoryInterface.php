<?php

namespace App\Interfaces;

interface AuthRepositoryInterface
{
    public function login($request);
    public function signup($request);
    public function sendPasswordResetLink($request);
    public function resetPassword($request);
    public function getUserStatus($request);
    public function getUserRole($request);
    public function logout();
}
