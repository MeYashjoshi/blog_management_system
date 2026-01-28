<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [

        'blog_id',
        'user_id',
        'comment',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

     public function blog()
     {
         return $this->belongsTo(Blog::class, 'blog_id');
     }
        public function user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }

}
