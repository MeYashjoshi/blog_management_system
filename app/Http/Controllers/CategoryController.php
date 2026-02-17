<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends BaseController
{
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function showCategories(Request $request)
    {

        $this->checkPermission("category-view");

        $filters = [
            'status'   => $request->get('status', 'all'),
            'search'   => $request->get('search', ''),
            'page'     => $request->get('page', 1),
            'itemPerPage' => $request->get('itemPerPage', 10),
        ];
        try {

            $res = $this->categoryRepository->getCategories($filters);
            if ($request->ajax()) {
                return view(
                    'dashboard.partials.categories-table',
                    compact('res')
                )->render();
            }
            $categoryStatistics = $this->categoryStatistics();

            return view('dashboard.categories', compact('categoryStatistics'));
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function showManageCategory(Request $request)
    {


        $this->checkPermission("category-view");

        try {

            $category =  $this->categoryRepository->getCategoryDetails($request->id);
            return view('dashboard.managecategory', compact('category'));
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function getCategoryDetails() {}
    public function getCategories() {}
    public function manageCategory(StoreCategoryRequest $request)
    {



        $this->checkPermission("category-create");

        try {


            $resp =  $this->categoryRepository->manageCategory($request->validated());


            if ($resp == 201) {
                return redirect()->route('categories.page')->with('success', 'category created successfully.');
            } elseif ($resp == 200) {
                return back()->with('success', 'category updated successfully.');
            }
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }
    public function statusCategory() {}

    public function categoryStatistics()
    {


        $resp =  $this->categoryRepository->categoryStatistics(null);

        return $resp;
    }

    public function deleteCategory(Request $request)
    {

        try {

            $resp =  $this->categoryRepository->deleteCategory($request->id);

            if ($resp == 204) {
                return back()->with('success', 'category deleted successfully.');
            }
            return $resp;
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
