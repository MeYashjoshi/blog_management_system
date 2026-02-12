<?php

namespace App\Interfaces;

interface TagRepositoryInterface
{
    public function getTagDetails($request);
    public function getTags($request);
    public function manageTag($request);
    public function statusTag($request);
    public function tagStatistics($request);
    public function deleteTag($request);
    public function searchTags($query);
}
