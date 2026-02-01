<?php

namespace App\Http\Controllers;

use App\Interfaces\BlogRepositoryInterface;
use Illuminate\Http\Request;

class BlogController extends BaseController
{
    protected BlogRepositoryInterface $BlogRepository;

    public function __construct(BlogRepositoryInterface $BlogRepository) {
        $this->BlogRepository = $BlogRepository;
    }

    public function showBlogs()
    {
        // $blogs = $this->BlogRepository->getBlogs();
        $blogs = "hello";

        return view('frontend.blogs', compact('blogs'));
    }

    public function showBlog(Request $request)
    {
        $blog = $this->BlogRepository->getBlogs();
        return view('frontend.blogsingle', compact('blog'));
    }

    public function showMyBlogs()
    {
        return view('dashboard.myblogs');
    }

    public function showBlogRequests()
    {
        return view('dashboard.blogrequests');
    }

    public function showBlogRequestedBlog()
    {
        return view('dashboard.requestedblog');
    }

    public function showManageBlog()
    {
        return view('dashboard.manageblog');
    }


    public function getBlogDetails()
    {

    }

    public function getBlogs(){

        $blogs = $this->BlogRepository->getBlogs();
        return $blogs;

    }

    public function manageBlog()
    {

    }

    public function statusBlog()
    {

    }

    public function blogStatistics()
    {

    }

    public function RecentBlogs()
    {

    }

    public function trendingBlogs()
    {

    }

    public function deleteBlog()
    {

    }



}
