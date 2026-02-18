<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Exception;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected Category $categoryModel;

    public function __construct(Category $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }

    public function getCategoryDetails($request)
    {

        $category = $this->categoryModel->where('id', $request)->first();



        return $category;
    }
    public function getCategories($filters = [])
    {

        try {
            $filters = $filters ?? [];

            $categories = $this->categoryModel->query();

            if (!empty($filters['status']) && $filters['status'] != 'all') {
                $categories->where('status', $filters['status']);
            }

            if (!empty($filters['search'])) {
                $categories->where('title', 'like', '%' . $filters['search'] . '%');
            }

            $perPage = $filters['itemPerPage'] ?? 10;
            $page    = $filters['page'] ?? 1;

            if ($perPage === 'All') {
                $total = $categories->count();
                return $categories->paginate($total);
            }

            return $categories->paginate(
                $perPage,
                ['*'],
                'page',
                $page
            )->withQueryString();
        } catch (Exception $e) {
            dd($e);
            throw new Exception("Failed to get categories: " . $e->getMessage());
        }
    }

    public function manageCategory($request)
    {
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
    public function statusCategory($request) {}
    public function categoryStatistics($request)
    {


        $category['total'] = $this->categoryModel->count();
        $category['active'] = $this->categoryModel->where('status', Category::STATUS_ACTIVE)->count();
        $category['inactive'] = $this->categoryModel->where('status', Category::STATUS_INACTIVE)->count();
        $category['pending'] = $this->categoryModel->where('status', Category::STATUS_PENDING)->count();

        // Category::status("0");

        //  dd(Category::status(2)->count());

        return $category;
    }

    public function deleteCategory($request)
    {

        try {
            $category = $this->categoryModel->where('id', $request)->first();

            $category->deleteOrFail();

            return 204;
        } catch (Exception $e) {
            dd($e);
            throw new Exception("Failed to delete category: " . $e->getMessage());
        }
    }
}
