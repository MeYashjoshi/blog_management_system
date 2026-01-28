<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function getCategoryDetails($request);
    public function getCategories($request);
    public function manageCategory($request);
    public function statusCategory($request);
    public function categoryStatistics($request);
    public function deleteCategory($request);
}
