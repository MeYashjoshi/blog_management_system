<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;

class UserController extends BaseController
{

    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function showProfile()
    {
        return view('dashboard.profile');
    }

    public function getUserDetails()
    {
    }

    public function getUsers()
    {
    }

    public function manageUser()
    {
    }

    public function statusUser()
    {
    }

    public function userStatistics()
    {
    }

    public function BlogsByAuthor()
    {
    }

    public function deleteUser()
    {
    }

}
