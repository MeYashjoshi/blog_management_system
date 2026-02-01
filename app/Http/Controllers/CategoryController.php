<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    // protected CategoryRepositoryInterface $categoryRepository;

    // public function __construct(CategoryRepositoryInterface $categoryRepository) {
    //     $this->categoryRepository = $categoryRepository;
    // }

     public function showCategories()
    {
        $this->checkPermission("category-view");
        return view('dashboard.categories');
    }

     public function showManageCategory()
    {
        $this->checkPermission("category-view");
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
