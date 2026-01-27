<?php

namespace App\Interfaces;

interface BlogTagRepositoryInterface
{
   public function listTags($request);
   public function getTagDetails($request);
   public function manageTag($request);
   public function deleteTag($request);
}
