<?php

namespace App\Repositories;

use App\Interfaces\SystemSettingRepositoryInterface;
use App\Models\SystemSetting;
use App\Traits\deleteFile;
use App\Traits\imageUpload;
use Exception;

class SystemSettingRepository implements SystemSettingRepositoryInterface
{

    protected SystemSetting $systemsettingModel;

    use imageUpload, deleteFile;

    public function __construct(SystemSetting $systemsettingModel)
    {
        $this->systemsettingModel = $systemsettingModel;
    }

    public function getSystemSettingDetails($request)
    {
        return $this->systemsettingModel->first();
    }

    public function getSystemSettings($request)
    {
        return $this->systemsettingModel->first();
    }

    public function manageSystemSetting($request)
    {
        // dd($request);
        $setting = $this->systemsettingModel->first();

        try {

            $faviconfilename = $setting->favicon; //old file

            if (isset($request['favicon'])) {

                $file = $request['favicon'];
                $faviconfilename = $file ? $this->uploadImage($file) : ($request['favicon'] ?? null);

                $file->storeAs($this->systemsettingModel::FILE_PATH, $faviconfilename);

                if($faviconfilename && $setting->favicon && $faviconfilename != $setting->favicon) {
                    $this->deleteFile($this->systemsettingModel::FILE_PATH . $setting->favicon);
                }

                $setting->favicon = $faviconfilename;
            }

            if (isset($request['sitelogo'])) {

                $file = $request['sitelogo'];
                $siteLogofilename = $file ? $this->uploadImage($file) : ($request['sitelogo'] ?? null);

                $file->storeAs($this->systemsettingModel::FILE_PATH, $siteLogofilename);

                if($siteLogofilename && $setting->sitelogo && $siteLogofilename != $setting->sitelogo) {
                    $this->deleteFile($this->systemsettingModel::FILE_PATH . $setting->sitelogo);
                }

                $setting->sitelogo = $siteLogofilename;
            }

            $setting->sitename = $request['sitename'];
            $setting->supportemail = $request['supportemail'];
            $setting->contactnumber = $request['contactnumber'];
            $setting->address = $request['address'];

            $setting->save();
            return 200;
        } catch (Exception $e) {
            throw new Exception("Failed to update system settings: " . $e->getMessage());
        }
    }

    public function statusSystemSetting($request) {}

    public function userSystemSettings($request) {}

    public function deleteSystemSetting($request) {}

}
