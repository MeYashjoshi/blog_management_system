<?php

namespace App\Repositories;

use App\Interfaces\BlogRepositoryInterface;
use App\Models\Blog;

class BlogRepository implements BlogRepositoryInterface
{
    protected Blog $blogModel;

    public function __construct(Blog $blogModel) {
        $this->blogModel = $blogModel;
    }

    public function getBlogDetails($request)
    {
    }
    public function getBlogs()
    {
        return Blog::getAll();
    }

    public function manageBlog($request)
    {
    }
    public function statusBlog($request)
    {
    }
    public function blogStatistics($request)
    {
    }
    public function RecentBlogs($request)
    {
    }
    public function trendingBlogs($request)
    {
    }
    public function deleteBlog($request)
    {
    }

}
