<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagController extends Controller
{

    public function showTags()
    {
        return view("dashboard.tags");
    }

    public function showManageTag()
    {
        return view("dashboard.managetag");
    }


    public function listTags()
    {
    }

    public function getTagDetails()
    {
    }

    public function manageTag()
    {
    }

    public function deleteTag()
    {
    }
}
