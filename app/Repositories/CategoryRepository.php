<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected Category $categoryModel;

    public function __construct(Category $categoryModel) {
        $this->categoryModel = $categoryModel;
    }

    public function getCategoryDetails($request){

    }
    public function getCategories($request){

    }
    public function manageCategory($request){

    }
    public function statusCategory($request){

    }
    public function categoryStatistics($request){

    }
    public function deleteCategory($request){

    }


}
