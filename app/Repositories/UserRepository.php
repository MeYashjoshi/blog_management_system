<?php

 namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

 class UserRepository implements UserRepositoryInterface{

    protected User $userModel;

    public function __construct(User $userModel) {
        $this->userModel = $userModel;
    }

    public function getUserDetails($request){

    }
    public function getUsers($request){

    }
    public function manageUser($request){

    }
    public function statusUser($request){

    }
    public function userStatistics($request){

    }
    public function deleteUser($request){

    }

 }
