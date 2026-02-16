<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Interfaces\TagRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class TagController extends BaseController
{
    protected TagRepositoryInterface $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function showTags(Request $request)
    {
        try {
            $this->checkPermission('tag-view');

            $tags = $this->tagRepository->getTags($request);
            $tagStatistics = $this->tagStatistics();

            return view('dashboard.tags', compact('tags', 'tagStatistics'));
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function showManageTag(Request $request)
    {

        try {
            $this->checkPermission('tag-view');

            $tag = $this->tagRepository->getTagDetails($request->id);

            return view('dashboard.managetag', compact('tag'));
        } catch (\Throwable $e) {
            dd($e);

            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function tagStatistics()
    {


        $resp =  $this->tagRepository->tagStatistics(null);

        return $resp;
    }

    public function listTags()
    {
        try {
            $this->checkPermission('tag-view');

            $tags = $this->tagRepository->getTags(null);

            return response()->json([
                'tags' => $tags,
            ]);
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function getTagDetails() {}

    public function manageTag(StoreTagRequest $request)
    {

        try {

            $this->checkPermission('tag-create');

            $tags = $this->tagRepository->manageTag($request);
            if ($tags == 201) {
                return back()->with('success', 'Tag created successfully.');
            }

            return back()->with('success', 'Tag updated successfully.');
        } catch (Exception $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function deleteTag() {}

    public function searchTags(Request $request)
    {
        try {
            $tags = $this->tagRepository->searchTags($request->query('q'));

            return response()->json([
                'tags' => $tags,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to search tags: ' . $e->getMessage(),
            ], 500);
        }
    }
}
