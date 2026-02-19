<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Traits\imageUpload;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    protected User $userModel;

    use imageUpload;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function getUserDetails($request)
    {

        return $this->userModel->where("id", $request->id)->first();
    }
    public function getUsers($request)
    {
    }


    public function manageUser($request)
    {
        // dd($request->all());
        try {


            $filename = null;

            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $filename = $this->uploadImage($file);
                $file->storeAs($this->userModel::FILE_PATH, $filename);
            }

            if (Auth::check()) {

                // UPDATE (Profile Edit)
                $user = $this->userModel->findOrFail(Auth::id());

                $user->update([
                    'firstname' => $request['firstname'],
                    'lastname' => $request['lastname'],
                    'email' => $request['email'],
                    'profile' => $filename ?? $user->profile,
                    'bio' => $request['bio'],
                ]);

            } else {
                $user = $this->userModel->where('email', $request['email'])->first();
                if ($user) {
                    return 409;
                }
                $user = $this->userModel->create([
                    'firstname' => $request['firstname'],
                    'lastname' => $request['lastname'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'profile' => $filename,
                    'bio' => $request['bio'] ?? null,
                ]);
            }
            if ($user->wasRecentlyCreated) {
                return $user;
            }

            return 200;

        } catch (Exception $e) {
            dd($e);
            throw new Exception("Failed to manage profile: " . $e->getMessage());
        }
    }

    public function changePassword($request)
    {
        try {
            $user = $this->userModel->where('id', Auth::id())->first();

            if (!Hash::check($request['currentpassword'], $user->password)) {
                return 1;
            }

            if ($request['newpassword'] !== $request['confirmpassword']) {
                return 2;
            }

            $user->password = bcrypt($request['newpassword']);
            $user->save();

            // return $user;
            return 0;
        } catch (Exception $e) {
            throw new Exception("Failed to change password: " . $e->getMessage());
        }
    }




    public function statusUser($request)
    {
    }
    public function userStatistics($request)
    {
    }
    public function deleteUser($request)
    {
    }
}
