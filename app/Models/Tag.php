<?php

namespace App\Models;

use App\Traits\deleteFile;
use App\Traits\PreventsDeletion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    use PreventsDeletion;


    const STATUS_PENDING = '0';
    const STATUS_ACTIVE = '1';
    const STATUS_INACTIVE = '2';

    protected array $blockDeleteIfHas = ['blogs'];

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
        return Blog::whereJsonContains('tag_ids', $this->id);
    }
}
