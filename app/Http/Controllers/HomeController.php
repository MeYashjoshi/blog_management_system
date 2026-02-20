<?php

namespace App\Http\Controllers;

use App\Interfaces\BlogRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends BaseController
{
    protected BlogRepositoryInterface $blogRepository;
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(BlogRepositoryInterface $blogRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->categoryRepository = $categoryRepository;
    }


    public function showHome()
    {
        return view('frontend.index');
    }

    public function showDashboard()
    {
        $this->checkPermission("system-dashboard");
        return view('dashboard.index');

    }

    public function showAbout()
    {
        return view('frontend.about');
    }
    public function showContactus()
    {
        return view('frontend.contactus');
    }
    public function showBlogs()
    {
        // $blogs = $this->BlogRepository->getBlogs();
        $blogs = "hello";

        return view('frontend.blogs', compact('blogs'));
    }
}
