<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
     public function showCategories()
    {
         return view('dashboard.categories');
    }

     public function showManageCategory()
    {
         return view('dashboard.managecategory');
    }

     public function getCategoryDetails()
    {

    }
     public function getCategories()
    {

    }
     public function manageCategory()
    {

    }
     public function statusCategory()
    {

    }
     public function categoryStatistics()
    {

    }
     public function deleteCategory()
    {

    }
}
