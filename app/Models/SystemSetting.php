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

    public function getSitelogoUrlAttribute()
    {
         if ($this->sitelogo) {
            return asset('storage/public/' . self::FILE_PATH . $this->sitelogo);
        } else {
            return asset('images/default-sitelogo.png');
        }
    }

    public function getFaviconUrlAttribute()
    {
         if ($this->favicon) {
            return asset('storage/public/' . self::FILE_PATH . $this->favicon);
        } else {
            return asset('images/default-favicon.png');
        }
    }

}
