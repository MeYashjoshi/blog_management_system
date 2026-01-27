<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getUserDetails($request);
    public function getUsers($request);
    public function manageUser($request);
    public function statusUser($request);
    public function userStatistics($request);
    public function deleteUser($request);
}
