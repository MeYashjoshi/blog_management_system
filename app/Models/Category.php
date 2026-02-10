<?php

namespace App\Models;

use App\Traits\PreventsDeletion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
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
    ];

     public function blogs()
     {
        return $this->hasMany(Blog::class, 'category_id');
     }


    //  public function scopeStatus(Builder $query, string $type): void
    // {
    //     $query->where('status', $type);
    // }

    public function getCreatedDateAttribute(){


        $date = Carbon::parse($this->created_at)->toDateString();

        return $date;

    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

}
