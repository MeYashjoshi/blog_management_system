<?php

namespace App\Interfaces;

interface BlogRepositoryInterface
{
    public function getBlogDetails($request);
    public function getBlogs($request);
    public function getRequestedBlogs($request);
    public function getRequestedBlog($request);
    public function manageBlog($request);
    public function statusBlog($request);
    public function blogStatistics();
    public function RecentBlogs($request);
    public function trendingBlogs($request);
    public function deleteBlog($request);
    public function updateBlogStatus($request);
}
