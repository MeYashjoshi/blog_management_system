<?php

namespace App\Repositories;

use App\Interfaces\BlogRepositoryInterface;
use App\Models\Blog;
use App\Traits\deleteFile;
use App\Traits\imageUpload;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BlogRepository implements BlogRepositoryInterface
{
    protected Blog $blogModel;
    use imageUpload, deleteFile;

    public function __construct(Blog $blogModel)
    {
        $this->blogModel = $blogModel;
    }

    public function getBlogDetails($request)
    {
        try {

            $blog = $this->blogModel->where('id', $request['id'])->first();

            return $blog;
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function getBlogs()
    {
        $blogs = $this->blogModel->all();
        return $blogs;
    }

    public function manageBlog($request)
    {

        try {
          
            $blog = $this->blogModel->where('id', $request['id'])->first();


            $filename = $blog?->featured_image; //old file

            if (isset($request['featured_image'])) {

                $file = $request['featured_image'];
                $filename = $file ? $this->uploadImage($file) : ($request['featured_image'] ?? null);

                $file->storeAs($this->blogModel::FILE_PATH, $filename);
            }

            $blog = $this->blogModel->updateOrCreate([
                'id' => $request['id']
            ], [
                'author_id' =>  Auth::id(),
                'category_id' =>  $request['category_id'],
                'slung' =>  Str::slug($request['title']),
                'featured_image' =>  $filename,
                'title' =>  $request['title'],
                'content' =>  $request['content'],
                'tags' =>  $request['tags'],
                'published_at' =>  now(),
                'status' =>  $request['status'],
            ]);

            if ($blog->wasRecentlyCreated) {
                return 201;
            }

            return 200;
        } catch (\Throwable $e) {
            dd($e);
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }
    public function statusBlog($request) {}

    public function blogStatistics() {
        $blog['total'] = $this->blogModel->count();
        $blog['published'] = $this->blogModel->where('status', Blog::STATUS_ACTIVE)->count();
        $blog['draft'] = $this->blogModel->where('status', Blog::STATUS_DRAFT)->count();
        $blog['rejected'] = $this->blogModel->where('status', Blog::STATUS_REJECTED)->count();

        return $blog;

    }
    public function RecentBlogs($request) {}
    public function trendingBlogs($request) {}

    public function deleteBlog($request)
    {
        try {
            $blog = $this->blogModel->where('id', $request)->first();

            $this->deleteFile($this->blogModel::FILE_PATH . $blog->featured_image);


            $blog->deleteOrFail();

            return 204;
        } catch (Exception $e) {

            throw new Exception("Failed to delete category: " . $e->getMessage());
        }
    }
}
