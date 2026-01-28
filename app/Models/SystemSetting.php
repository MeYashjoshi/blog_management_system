<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    public const FILE_PATH = 'uploads/system_settings/';

    protected $fillable = [

        'sitename',
        'sitelogo',
        'favicon',
        'supportemail',
        'contactnumber',
        'address',

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

}
