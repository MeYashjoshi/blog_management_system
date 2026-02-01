<?php

namespace App\Repositories;

use App\Interfaces\SystemSettingRepositoryInterface;
use App\Models\SystemSetting;
use App\Traits\imageUpload;

class SystemSettingRepository implements SystemSettingRepositoryInterface{

    protected SystemSetting $systemsettingModel;

    use imageUpload;

    public function __construct(SystemSetting $systemsettingModel) {
        $this->systemsettingModel = $systemsettingModel;
    }

    public function getSystemSettingDetails($request){
        return $this->systemsettingModel->first();
    }

    public function getSystemSettings($request){
        return $this->systemsettingModel->first();
    }

    public function manageSystemSetting($request){
        $setting = $this->systemsettingModel->first();
        
    
        if ($request->hasFile('favicon')) {
            $file = $request['favicon'];
            $filename = $file ? $this->uploadImage($file) :($request['favicon'] ?? null);
            
            if ($filename) {
                $file->storeAs('public/' . $this->systemsettingModel::FILE_PATH, $filename);
                $setting->favicon = $filename;
            }
        }
        if ($request->hasFile('siteLogo')) {
            $file = $request['siteLogo'];
            $filename = $file ? $this->uploadImage($file) : ($request['siteLogo'] ?? null);
            
            if ($filename) {
                $file->storeAs('public/' . $this->systemsettingModel::FILE_PATH, $filename);
                $setting->sitelogo = $filename;
            }
        }

        $setting->sitename = $request->input('siteName', $setting->sitename ?? '');
        $setting->supportemail = $request->input('supportEmail', $setting->supportemail ?? '');
        $setting->contactnumber = $request->input('contactNumber', $setting->contactnumber ?? '');
        $setting->address = $request->input('address', $setting->address ?? '');

        $setting->save();
        return $setting;
    }

    public function statusSystemSetting($request){

    }

    public function userSystemSettings($request){

    }

    public function deleteSystemSetting($request){

    }

    private function deleteFile($path) {
        $fullPath = storage_path($path);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

}
