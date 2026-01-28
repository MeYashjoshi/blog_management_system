<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    const STATUS_PENDING = '0';
    const STATUS_ACTIVE = '1';
    const STATUS_INACTIVE = '2';

    protected $fillable = [

        'title',
        'description',
        'status',

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


    public function blogs()
    {
        return $this->belongsToMany(Blog::class,'tag_id');
    }



}
