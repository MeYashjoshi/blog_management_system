<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{


   protected function checkPermission(string $permission){

        if(!Auth::user()->can($permission)){
            abort(403);
        }
   }

   protected function checkRole(string $role){

        if(!Auth::user()->hasRole($role)){
            abort(403);
        }


   }
}
