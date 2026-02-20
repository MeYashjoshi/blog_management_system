<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Interfaces\UserRepositoryInterface;
use Exception;
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

    public function showUsers(Request $request)
    {
        $this->checkPermission("system-profile");

        $filters = [
            'status' => $request->get('status', 'all'),
            'search' => $request->get('search', ''),
            'page' => $request->get('page', 1),
            'itemPerPage' => $request->get('itemPerPage', 10),
        ];

        try {
            $users = $this->userRepository->getUsers($filters);
            $userStatistics = $this->userStatistics();
            if ($request->ajax()) {
                return view(
                    'dashboard.partials.users-table',
                    compact('users')
                )->render();
            }
            return view('dashboard.users', compact('userStatistics'));
        } catch (Exception $e) {
            dd($e);
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function showUserRequests(Request $request)
    {

        $filters = [
            'status' => $request->get('status', 'all'),
            'search' => $request->get('search', ''),
            'page' => $request->get('page', 1),
            'itemPerPage' => $request->get('itemPerPage', 10),
            'requested' => true,
        ];

        try {
            $users = $this->userRepository->getUsers($filters);

            $userStatistics = $this->userStatistics();
            if ($request->ajax()) {
                return view(
                    'dashboard.partials.users-table',
                    compact('users')
                )->render();
            }
            return view('dashboard.userrequests', compact('userStatistics'));
        } catch (Exception $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }

    }

    public function getUserDetails(Request $request)
    {
        try {
            $user = $this->userRepository->getUserDetails($request);
            return view('dashboard.manageuser', compact('user'));
        } catch (\Throwable $th) {
            return back()->withErrors([
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function getUsers()
    {
    }

    public function manageUser(UpdateProfileRequest $request)
    {


        $this->checkPermission("system-profile");

        try {
            $resp = $this->userRepository->manageUser($request->validated());

            if ($resp == 200) {
                return back()->with('success', 'Profile updated successfully.');
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
            $resp = $this->userRepository->changePassword($request->validated());
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

            return back()->with('password_success', 'Password changed successfully.');
        } catch (\Exception $e) {

            return back()->withErrors([
                'password_error' => $e->getMessage(),
            ]);
        }
    }

    public function statusUser(Request $request)
    {
        try {
            $resp = $this->userRepository->statusUser($request);

            return back()->with('success', 'User status changed successfully.');
        } catch (Exception $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function userStatistics()
    {
        try {
            $userStatistics = $this->userRepository->userStatistics();
            return $userStatistics;
        } catch (\Throwable $th) {
            return back()->withErrors([
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function BlogsByAuthor()
    {
    }

    public function deleteUser()
    {
    }
}
