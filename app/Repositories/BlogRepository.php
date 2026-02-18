<?php

namespace App\Repositories;

use App\Interfaces\BlogRepositoryInterface;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
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


            $blog = $this->blogModel->where('slung', $request->slug)->first();

            return $blog;
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function getBlogs($filters)
    {
        try {
            $blogs = $this->blogModel->with('category');

            if ($filters['status'] != '' && $filters['status'] != 'all') {
                $blogs->where('status', $filters['status']);
            }

            if ($filters['category'] != '' && $filters['category'] !== 'all') {
                $blogs->where('category_id', $filters['category']);
            }

            if ($filters['search'] != '') {
                $blogs->where('title', 'like', '%' . $filters['search'] . '%');
            }
            if ($filters['itemPerPage'] == 'All') {
                $total = $blogs->count();
                return $blogs->paginate($total);
            }
            return $blogs->paginate(
                $filters['itemPerPage'],
                ['*'],
                'page',
                $filters['page'] ?? 1
            )->withQueryString();
        } catch (Exception $e) {
            throw new Exception("Failed to get blogs: " . $e->getMessage());
        }
    }

    public function getRequestedBlogs($filters)
    {
        $blogs = $this->blogModel
            ->whereIn('status', [
                Blog::STATUS_PENDING,
                Blog::STATUS_REJECTED,
                Blog::STATUS_ACTIVE,
                Blog::STATUS_UNPUBLISHED
            ])
            ->with(['author', 'category']);

        if ($filters['status'] != '' && $filters['status'] != 'all') {
            $blogs->where('status', $filters['status']);
        }

        if ($filters['category'] != '' && $filters['category'] !== 'all') {
            $blogs->where('category_id', $filters['category']);
        }

        if ($filters['search'] != '') {
            $blogs->where('title', 'like', '%' . $filters['search'] . '%');
        }
        if ($filters['itemPerPage'] == 'All') {
            $total = $blogs->count();
            return $blogs->paginate($total);
        }

        return $blogs->paginate(
            $filters['itemPerPage'],
            ['*'],
            'page',
            $filters['page'] ?? 1
        )->withQueryString();

        // return $blogs->paginate($filters['page'])->withQueryString();
    }


    public function getRequestedBlog($request)
    {
        try {
            $RequestedBlog = $this->blogModel->where('slung', $request->slug)->first();

            return $RequestedBlog;
        } catch (\Throwable $e) {
            return back()->withErrors([
                "errors" => $e->getMessage(),
            ]);
        }
    }

    public function manageBlog($request)
    {

        try {


            if (!empty($request['tags'])) {
                $tags = $request['tags'];
                $tagIds = [];
                foreach ($tags as $tag) {
                    $tag = trim($tag);
                    if (!is_numeric($tag)) {
                        $tag = Str::title($tag);
                        $newTag = Tag::create(['title' => $tag, 'status' => Tag::STATUS_ACTIVE, 'description' => "This tag is associated with " . $tag]);
                        $tagIds[] = $newTag->id;
                    } else {
                        $existingTag = Tag::where('id', $tag)->first();
                        $tagIds[] = $existingTag->id;
                    }
                    $request['tag_ids'] = $tagIds;
                }
            }


            $blog = $this->blogModel->where('id', $request['id'])->first();


            $filename = $blog?->featured_image; //old file

            if (isset($request['featured_image'])) {

                $file = $request['featured_image'];

                $filename = $file ? $this->uploadImage($file) : ($request['featured_image'] ?? null);

                if ($filename && $blog?->featured_image && $filename != $blog->featured_image) {
                    $this->deleteFile($this->blogModel::FILE_PATH . $blog->featured_image);
                }

                $file->storeAs($this->blogModel::FILE_PATH, $filename);
            }
            // dd($filename);

            $blog = $this->blogModel->updateOrCreate([
                'id' => $request['id']
            ], [
                'author_id' =>  Auth::id(),
                'category_id' =>  $request['category_id'],
                'slung' =>  Str::slug($request['title']),
                'featured_image' =>  $filename,
                'title' =>  $request['title'],
                'content' =>  $request['content'],
                'tag_ids' =>  $request['tag_ids'] ?? [],
                'published_at' =>  now(),
                'status' =>  $request['status'],
                'rejection_reason' => 'N/A'
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

    public function statusBlog($request)
    {
        try {
            $blog = $this->blogModel->where('id', $request['id'])->first();


            if ($blog->status == Blog::STATUS_ACTIVE) {
                $blog->status = Blog::STATUS_INACTIVE;
            } else {
                $blog->status = Blog::STATUS_ACTIVE;
            }

            $blog->save();


            return 200;
        } catch (\Throwable $e) {
            dd($e);
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function blogStatistics()
    {
        $blog['total'] = $this->blogModel->count();
        $blog['published'] = $this->blogModel->where('status', Blog::STATUS_ACTIVE)->count();
        $blog['draft'] = $this->blogModel->where('status', Blog::STATUS_DRAFT)->count();
        $blog['rejected'] = $this->blogModel->where('status', Blog::STATUS_REJECTED)->count();
        $blog['Requested'] = $this->blogModel->where('status', Blog::STATUS_PENDING)->count();

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

    public function updateBlogStatus($request)
    {

        try {



            if ($request->status == 1) {

                $request->rejection_reason = "N/A";
            }


            $blog = $this->blogModel->where('id', $request->id)->first();

            if ($request->status == Blog::STATUS_REJECTED && $blog->status == Blog::STATUS_REJECTED) {
                throw new Exception("The blog is already rejected.");
            } elseif ($request->status == Blog::STATUS_ACTIVE && $blog->status == Blog::STATUS_ACTIVE) {
                throw new Exception("The blog is already approved.");
            }



            $blog->status = $request->status;
            $blog->rejection_reason = $request->rejection_reason;
            $blog->save();
            return 200;
        } catch (Exception $e) {

            throw new Exception("Failed to update blog status: " . $e->getMessage());
        }
    }

    public function blogHasTag(int $blogId, int $tagId): bool
    {
        $blog = Blog::find($blogId);

        if (!$blog) {
            return false;
        }

        return in_array($tagId, $blog->tag_ids ?? []);
    }
}
