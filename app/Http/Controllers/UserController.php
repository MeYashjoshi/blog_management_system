<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{

    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function showProfile()
    {
        $this->checkPermission("system-profile");


        $user = $this->userRepository->getUserDetails(Auth::user());


        return view('dashboard.profile', compact('user'));
    }

    public function getUserDetails() {}

    public function getUsers() {}

    public function manageUser(UpdateProfileRequest $request)
    {


        $this->checkPermission("system-profile");

        try {
             $resp = $this->userRepository->manageUser($request->validated());

            if ($resp == 200) {
                return back()->with('success','Profile updated successfully.');
            }

        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }

    }

    public function changePassword(UpdatePasswordRequest $request)
    {


        $this->checkPermission("system-profile");

        try {
           $resp =  $this->userRepository->changePassword($request->validated());
            //  dd($resp);

            if ($resp == 1) {
                return back()->withErrors([
                    'password_error' => 'currentpassword is incorrect.',
                ]);
            } else if ($resp == 2) {
                return back()->withErrors([
                    'password_error' => 'New password and confirm password do not match.',
                ]);
            }

            return back()->with('password_success','Password changed successfully.');


        } catch (\Exception $e) {

            return back()->withErrors([
                'password_error' => $e->getMessage(),
            ]);
        }


    }

    public function statusUser() {}

    public function userStatistics() {}

    public function BlogsByAuthor() {}

    public function deleteUser() {}
}
