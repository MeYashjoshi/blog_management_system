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

        $settings = $this->systemsettingRepository->getSystemSettings(null);
        return view("dashboard.systemsettings", compact('settings'));
    }

    public function getSystemSettingDetails()
    {
        return $this->systemsettingRepository->getSystemSettingDetails(null);
    }

    public function getSystemSettings()
    {
        return $this->systemsettingRepository->getSystemSettings(null);
    }

    public function manageSystemSetting(Request $request)
    {
        $this->checkPermission("system-setting");
        
        $request->validate([
            'siteName' => 'required|string|max:255',
            'supportEmail' => 'required|email|max:255',
            'contactNumber' => 'required|string|max:20',
            'address' => 'required|string',
            'siteLogo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|max:1024',
        ]);

        $this->systemsettingRepository->manageSystemSetting($request);

        return back()->withErrors(
            ['success' => 'System settings updated successfully.']
        );
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
