<?php

namespace App\Http\Controllers;

use App\Interfaces\TagRepositoryInterface;
use Illuminate\Http\Request;

class TagController extends BaseController
{

    protected TagRepositoryInterface $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository) {
        $this->tagRepository = $tagRepository;
    }

    public function showTags()
    {
        return view("dashboard.tags");
    }

    public function showManageTag()
    {
        return view("dashboard.managetag");
    }


    public function listTags()
    {
    }

    public function getTagDetails()
    {
    }

    public function manageTag()
    {
    }

    public function deleteTag()
    {
    }
}
