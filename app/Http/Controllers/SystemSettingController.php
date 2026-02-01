<?php

namespace App\Http\Controllers;

use App\Interfaces\SystemSettingRepositoryInterface;
use Illuminate\Http\Request;

class SystemSettingController extends BaseController
{
    protected SystemSettingRepositoryInterface $systemsettingRepository;

    public function __construct(SystemSettingRepositoryInterface $systemsettingRepository) {
        $this->systemsettingRepository = $systemsettingRepository;
    }

    public function showSystemSettings()
    {
        $this->checkPermission("system-dashboard");

        return view("dashboard.systemsettings");
    }

    public function getSystemSettingDetails()
    {

    }

    public function getSystemSettings()
    {

    }

    public function manageSystemSetting()
    {

    }

    public function statusSystemSetting()
    {

    }

    public function userSystemSettings()
    {

    }

    public function deleteSystemSetting()
    {

    }

}
