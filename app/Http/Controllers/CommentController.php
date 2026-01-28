<?php

namespace App\Http\Controllers;

use App\Interfaces\CommentRepositoryInterface;
use Illuminate\Http\Request;

class CommentController extends BaseController
{

    protected CommentRepositoryInterface $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository) {
        $this->commentRepository = $commentRepository;
    }

    public function getCommentDetails()
    {

    }
    public function getComments()
    {

    }
    public function manageComment()
    {

    }
    public function statusComment()
    {

    }
    public function commentStatistics()
    {

    }
    public function deleteComment()
    {

    }
}
