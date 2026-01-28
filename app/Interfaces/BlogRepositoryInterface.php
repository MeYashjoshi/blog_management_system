<?php

namespace App\Interfaces;

interface BlogRepositoryInterface
{
    public function getBlogDetails($request);
    public function getBlogs();
    public function manageBlog($request);
    public function statusBlog($request);
    public function blogStatistics($request);
    public function RecentBlogs($request);
    public function trendingBlogs($request);
    public function deleteBlog($request);

}
