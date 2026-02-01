<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{

    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function showProfile()
    {
        $this->checkPermission("system-profile");
      
        
        $user = $this->userRepository->getUserDetails(Auth::user());
    

        return view('dashboard.profile', compact('user'));
    }

    public function getUserDetails()
    {
    }

    public function getUsers()
    {
    }

    public function manageUser(Request $request)
    {
        
        $this->checkPermission("system-profile");

        if ($request->newpassword) {

            if ($request->newpassword !== $request->confirmpassword) {
                return back()->withErrors([
                    'error' => 'New password and confirm password do not match.',
                ]);
            }

            $validatedData = $request->validate([
                'newpassword' => 'required|string|min:8',
                'confirmpassword' => 'required|string|min:8',
            ]);
            $this->userRepository->manageUser($validatedData);
            
            return back()->withErrors(
                ['password_success' => 'Password changed successfully.']);


        } else {

            $validatedData = $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'profile' => 'nullable|image|max:2048',
                'bio' => 'nullable|string',
            ]);


            $this->userRepository->manageUser($validatedData);


            return back()->withErrors([
                'success' => 'Profile updated successfully.',
            ]);
        }
        


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
