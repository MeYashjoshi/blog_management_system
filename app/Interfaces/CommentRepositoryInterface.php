<?php

namespace App\Interfaces;

interface CommentRepositoryInterface
{
    public function getCommentDetails($request);
    public function getComments($request);
    public function manageComment($request);
    public function statusComment($request);
    public function commentStatistics($request);
    public function deleteComment($request);
}
