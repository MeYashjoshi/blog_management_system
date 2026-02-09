<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    const STATUS_PENDING = '0';
    const STATUS_ACTIVE = '1';
    const STATUS_INACTIVE = '2';
    const STATUS_DRAFT = '3';
    const STATUS_REJECTED = '4';


    public const FILE_PATH = 'uploads/featured_images/';

    protected $fillable = [
        'author_id',
        'category_id',
        'slung',
        'featured_image',
        'title',
        'content',
        'tags',
        'published_at',
        'status',
        'rejection_reason',
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

    // protected $casts = [
    //     'tags' => 'json',
    // ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'blog_id');
    }

    public function setTagsAttribute($value)
    {
        $this->attributes['tags'] = json_encode($value);
    }



    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            return asset('storage/' . self::FILE_PATH . $this->featured_image);
        }
        return asset('storage/' . self::FILE_PATH . $this->featured_image.'default-featured-image.svg');
    }


    public function getBlogTagsAttribute()
    {
        return json_decode($this->tags);
    }







}
