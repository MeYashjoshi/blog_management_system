<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Interfaces\BlogRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use Exception;
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
        $blog = $this->blogRepository->getBlogs(null);
        return view('frontend.blogsingle', compact('blog'));
    }

    public function showMyBlogs(Request $request)
    {

        $filters = [
            'status'   => $request->get('status', 'all'),
            'category' => $request->get('category', 'all'),
            'search'   => $request->get('search', ''),
            'page'     => $request->get('page', 1),
            'itemPerPage' => $request->get('itemPerPage', 10),
        ];


        try {

            $blogs = $this->blogRepository->getBlogs($filters);

            if ($request->ajax()) {
                return view(
                    'dashboard.partials.my-blogs-table',
                    compact('blogs')
                )->render();
            }

            $categories = $this->categoryRepository->getCategories(null);
            $blogStatistics = $this->blogStatistics();

            return view(
                'dashboard.myblogs',
                compact('categories', 'blogStatistics')
            );
        } catch (\Throwable $e) {

            if ($request->ajax()) {
                return response()->json([
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function getRequestedBlogs(Request $request)
    {

        $this->checkPermission('blog-request');
        $this->checkRole('admin');

        $filters = [
            'status'   => $request->get('status', 'all'),
            'category' => $request->get('category', 'all'),
            'search'   => $request->get('search', ''),
            'page'     => $request->get('page', 1),
            'itemPerPage' => $request->get('itemPerPage', 10),
        ];

        try {

            $requestedBlogs = $this->blogRepository->getRequestedBlogs($filters);


            if ($request->ajax()) {
                return view(
                    'dashboard.partials.requested-blogs-table',
                    compact('requestedBlogs')
                )->render();
            }

            $categories = $this->categoryRepository->getCategories(null);
            $blogStatistics = $this->blogStatistics();

            return view(
                'dashboard.blogrequests',
                compact('categories', 'blogStatistics')
            );
        } catch (\Throwable $e) {

            if ($request->ajax()) {
                return response()->json([
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }


    public function showRequestedBlog(Request $request)
    {
        $this->checkPermission('blog-request');
        $this->checkRole('admin');

        if (!$request->has('slug')) {
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

        $blogs = $this->blogRepository->getBlogs(null);
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

    public function statusBlog(request $request)
    {
        try {
            $this->blogRepository->statusBlog($request);
            return response()->json([
                'success' => true,
                'message' => 'Blog status updated successfully.',
            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

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
