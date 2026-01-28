<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
    ];

     public function blogs()
     {
         return $this->hasMany(Blog::class, 'category_id');
     }



}
