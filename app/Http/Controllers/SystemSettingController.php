<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSystemSettingsRequest;
use App\Interfaces\SystemSettingRepositoryInterface;
use Illuminate\Http\Request;

class SystemSettingController extends BaseController
{
    protected SystemSettingRepositoryInterface $systemsettingRepository;

    public function __construct(SystemSettingRepositoryInterface $systemsettingRepository)
    {
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

    public function manageSystemSetting(UpdateSystemSettingsRequest $request)
    {
        $this->checkPermission("system-setting");
        try {

            $resp = $this->systemsettingRepository->manageSystemSetting($request->validated());

            if ($resp == 200) {

                return back()->with('success', 'System settings updated successfully.');
            }


        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function statusSystemSetting() {}

    public function userSystemSettings() {}

    public function deleteSystemSetting() {}
}
