<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Exception;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected Category $categoryModel;

    public function __construct(Category $categoryModel) {
        $this->categoryModel = $categoryModel;
    }

    public function getCategoryDetails($request){

        $category = $this->categoryModel->where('id',$request)->first();



        return $category;


    }
    public function getCategories($request){

        $categories = $this->categoryModel->all();
        return $categories;

    }
    public function manageCategory($request){


        try {
            $category = $this->categoryModel->updateOrCreate(
                [
                    'id' => $request['id']
                ],
                [
                    'title' => $request['title'],
                    'description' => $request['description'] ?? null,
                    'status' => $request['status'],
                ]
            );

            if ($category->wasRecentlyCreated) {
                return 201;
            }

            return 200;
        } catch (Exception $e) {
            throw new Exception("Failed to manage category: " . $e->getMessage());
        }


    }
    public function statusCategory($request){

    }
    public function categoryStatistics($request){


        $category['total'] = $this->categoryModel->count();
        $category['active'] = $this->categoryModel->where('status', Category::STATUS_ACTIVE)->count();
        $category['inactive'] = $this->categoryModel->where('status', Category::STATUS_INACTIVE)->count();
        $category['pending'] = $this->categoryModel->where('status', Category::STATUS_PENDING)->count();

        // Category::status("0");

        //  dd(Category::status(2)->count());

        return $category;
    }




    public function deleteCategory($request){

        try {
            $category = $this->categoryModel->where('id',$request)->first();

            $category->deleteOrFail();

            return 204;

        } catch (Exception $e) {
            dd($e);
            throw new Exception("Failed to delete category: " . $e->getMessage());
        }
    }

}
