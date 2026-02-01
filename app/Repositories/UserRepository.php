<?php

 namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Traits\imageUpload;
use Illuminate\Support\Facades\Auth;

 class UserRepository implements UserRepositoryInterface{

    protected User $userModel;

    use imageUpload;

    public function __construct(User $userModel) {
        $this->userModel = $userModel;
    }

    public function getUserDetails($request){
       
        return $this->userModel->where("id",$request->id)->first();

    }
    public function getUsers($request){

    }
    public function manageUser($request){
   
// dd($request['profile']);
    
        $user = $this->userModel->where("id",Auth::user()->id)->first();

        if (isset($request['newpassword']) && isset($request['confirmpassword'])) {
            
            $user->password = bcrypt($request['newpassword']);
        } else {
            $file = $request['profile'];
            $filename =$file ? $this->uploadImage($file) : ($request['profile'] ?? null);

            $user->firstname = $request['firstname'];
            $user->lastname = $request['lastname'];
            $user->email = $request['email'];
            $user->profile = $filename;
            $user->bio = $request['bio'];
            
            if($file && $filename){
                $file->storeAs('public/'. $this->userModel::FILE_PATH, $filename);
            }
        }
        
        
       
        $user->save();  
        return $user;

    }
    public function statusUser($request){

    }
    public function userStatistics($request){

    }
    public function deleteUser($request){

    }

 }
