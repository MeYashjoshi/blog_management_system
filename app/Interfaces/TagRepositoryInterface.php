<?php

namespace App\Interfaces;

interface TagRepositoryInterface
{
   public function listTags($request);
   public function getTagDetails($request);
   public function manageTag($request);
   public function deleteTag($request);
}
