<?php

namespace App\Repositories;

use App\Interfaces\SystemSettingRepositoryInterface;
use App\Models\SystemSetting;

class SystemSettingRepository implements SystemSettingRepositoryInterface{

    protected SystemSetting $systemsettingModel;

    public function __construct(SystemSetting $systemsettingModel) {
        $this->systemsettingModel = $systemsettingModel;
    }

    public function getSystemSettingDetails($request){

    }
    public function getSystemSettings($request){

    }
    public function manageSystemSetting($request){

    }
    public function statusSystemSetting($request){

    }
    public function userSystemSettings($request){

    }
    public function deleteSystemSetting($request){

    }

}
