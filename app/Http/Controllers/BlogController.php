<?php

namespace App\Http\Controllers;

class BlogController extends Controller
{



    public function showBlogs()
    {
        return view('frontend.blogs');
    }

    public function showBlog()
    {
        return view('frontend.blogsingle');
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
