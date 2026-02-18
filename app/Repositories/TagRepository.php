<?php

namespace App\Repositories;

use App\Interfaces\TagRepositoryInterface;
use App\Models\Tag;
use Exception;

class TagRepository implements TagRepositoryInterface
{

    protected Tag $tagModel;

    public function __construct(Tag $tagModel)
    {
        $this->tagModel = $tagModel;
    }

    public function getTagDetails($request)
    {

        try {

            $tag = $this->tagModel->where('id', $request)->first();

            return $tag;
        } catch (\Throwable $e) {
            return back()->withErrors([
                "errors" => $e->getMessage(),
            ]);
        }


        return $tag;
    }

    public function getTags($filters)
    {

        try {
            $tags = $this->tagModel->query();

            if ($filters['status'] !== 'all') {
                $tags->where('status', $filters['status']);
            }
            if ($filters['search']) {
                $tags->where('title', 'like', '%' . $filters['search'] . '%');
            }

            if ($filters['itemPerPage'] === 'All') {
                $total = $tags->count();
                return $tags->paginate($total);
            }

            return $tags->paginate(
                $filters['itemPerPage'],
                ['*'],
                'page',
                $filters['page'] ?? 1
            )->withQueryString();
        } catch (Exception $e) {
            return back()->withErrors([
                'errors' => $e->getMessage(),
            ]);
        }
    }
    public function manageTag($request)
    {
        try {
            $tag = $this->tagModel->updateOrCreate(
                [
                    'id' => $request['id']
                ],
                [
                    'title' => $request['title'],
                    'description' => $request['description'] ?? null,
                    'status' => $request['status'],
                ]
            );

            if ($tag->wasRecentlyCreated) {
                return 201;
            }

            return 200;
        } catch (Exception $e) {
            throw new Exception("Failed to manage tag: " . $e->getMessage());
        }
    }
    public function statusTag($request) {}
    public function tagStatistics($request)
    {


        $tag['total'] = $this->tagModel->count();
        $tag['active'] = $this->tagModel->where('status', Tag::STATUS_ACTIVE)->count();
        $tag['inactive'] = $this->tagModel->where('status', Tag::STATUS_INACTIVE)->count();
        $tag['pending'] = $this->tagModel->where('status', Tag::STATUS_PENDING)->count();

        return $tag;
    }

    public function deleteTag($request)
    {

        try {
            $tag = $this->tagModel->where('id', $request)->first();

            $tag->deleteOrFail();

            return 204;
        } catch (Exception $e) {
            dd($e);
            throw new Exception("Failed to delete tag: " . $e->getMessage());
        }
    }

    public function searchTags($query)
    {
        try {
            $tags = $this->tagModel->where('title', 'LIKE', '%' . $query . '%')->where('status', Tag::STATUS_ACTIVE)->get();
            return $tags;
        } catch (Exception $e) {
            throw new Exception("Failed to search tags: " . $e->getMessage());
        }
    }
}
