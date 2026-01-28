<?php

namespace App\Repositories;

use App\Interfaces\TagRepositoryInterface;
use App\Models\Tag;

class TagRepository implements TagRepositoryInterface{

    protected Tag $tagModel;

    public function __construct(Tag $tagModel) {
        $this->tagModel = $tagModel;
    }

    public function listTags($request){

    }

    public function getTagDetails($request){

    }

    public function manageTag($request){

    }

    public function deleteTag($request){

    }

}
