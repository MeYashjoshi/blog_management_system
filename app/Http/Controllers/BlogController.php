<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Interfaces\BlogRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class BlogController extends BaseController
{
    protected BlogRepositoryInterface $blogRepository;
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(BlogRepositoryInterface $blogRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function showBlogs()
    {

        return view('frontend.blogs');
    }

    public function showBlog(Request $request)
    {
        $blog = $this->blogRepository->getBlogs();
        return view('frontend.blogsingle', compact('blog'));
    }

    public function showMyBlogs()
    {
        $blogs = $this->blogRepository->getBlogs();

        $blogStatistics = $this->blogStatistics();

        return view('dashboard.myblogs', compact('blogs', 'blogStatistics'));
    }

    public function getRequestedBlogs()
    {
        $this->checkPermission('blog-request');
        $this->checkRole('admin');

        try {
            $requestedBlogs = $this->blogRepository->getRequestedBlogs();
            $blogStatistics = $this->blogStatistics();


            return view('dashboard.blogrequests', compact('requestedBlogs', 'blogStatistics'));
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function showRequestedBlog(Request $request)
    {
        $this->checkPermission('blog-request');
        $this->checkRole('admin');

        if (!$request->has('id')) {
            return redirect()->route('blogrequests.page')->withErrors([
                'error' => 'Please select a blog to view details.',
            ]);
        }

        try {

            $requestedBlog = $this->blogRepository->getRequestedBlog($request);

            return view('dashboard.requestedblog', compact('requestedBlog'));
        } catch (\Throwable $e) {

            return back()->withErrors([
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function showManageBlog(Request $request)
    {

        $this->checkPermission("blog-edit");

        try {

            $blog = $this->blogRepository->getBlogDetails($request);
            $categories = $this->categoryRepository->getCategories(null);

            return view('dashboard.manageblog', compact('blog', 'categories'));
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }


    public function getBlogDetails() {}

    public function getBlogs()
    {

        $blogs = $this->blogRepository->getBlogs();
        return $blogs;
    }

    public function manageBlog(StoreBlogRequest $request)
    {

        $this->checkPermission("blog-create");

        try {

            $resp = $this->blogRepository->manageBlog($request->validated());

            if ($resp == 201) {
                return redirect()->route('myblogs.page')->with('success', 'blog created successfully.');
            } elseif ($resp == 200) {
                return back()->with('success', 'blog updated successfully.');
            }
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function statusBlog() {}

    public function blogStatistics()
    {
        try {
            $resp = $this->blogRepository->blogStatistics();
            return $resp;
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function RecentBlogs() {}

    public function trendingBlogs() {}

    public function deleteBlog(Request $request)
    {
        try {

            $resp =  $this->blogRepository->deleteBlog($request->id);

            if ($resp == 204) {
                return back()->with('success', 'blog deleted successfully.');
            }
            return $resp;
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function updateBlogStatus(UpdateStatusRequest $request)
    {

        try {
            $resp =  $this->blogRepository->updateBlogStatus($request);

            if ($resp == 200) {
                return back()->with('success', 'blog status updated successfully.');
            }
            return $resp;
        } catch (\Throwable $e) {

            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
