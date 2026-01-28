<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    protected Comment $commentModel;

    public function __construct(Comment $commentModel) {
        $this->commentModel = $commentModel;
    }

    public function getCommentDetails($request){

    }
    public function getComments($request){

    }
    public function manageComment($request){

    }
    public function statusComment($request){

    }
    public function commentStatistics($request){

    }
    public function deleteComment($request){

    }

}
