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
    public function getUsers($request) {}


    public function manageUser($request)
    {
        try {

            $user = $this->userModel->where('id', Auth::id())->first();


            $filename = $user->profile; //old file

            if (isset($request['profile'])) {

                $file = $request['profile'];
                $filename = $file ? $this->uploadImage($file) : ($request['profile'] ?? null);

                $file->storeAs('public/' . $this->userModel::FILE_PATH, $filename);
            }

            $user->firstname = $request['firstname'];
            $user->lastname  = $request['lastname'];
            $user->email     = $request['email'];
            $user->profile   = $filename;
            $user->bio       = $request['bio'];


            $user->save();
            return 200;
        }catch (Exception $e) {
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




    public function statusUser($request) {}
    public function userStatistics($request) {}
    public function deleteUser($request) {}
}
