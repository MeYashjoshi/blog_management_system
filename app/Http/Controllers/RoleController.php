<?php

namespace App\Http\Controllers;

use App\Interfaces\RoleRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    protected RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }


    public function showRolesAndPermissions()
    {
        try {
            $RolesAndPermissions = $this->roleRepository->getRolesAndPermissions();

            $ModulesAndPermission = $this->roleRepository->getModulesAndPermissions();

            return view('dashboard.rolesandpermissions', compact('RolesAndPermissions', 'ModulesAndPermission'));
        } catch (Exception $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function getModulesAndPermissions()
    {
        try {
            $modules = $this->roleRepository->getModulesAndPermissions();
            return $modules;
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function showManageRole(Request $request)
    {
        dd($request->all());
        $this->checkPermission("role-create");

        try {
            return view('dashboard.managerole');
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function showManageRolePermissions(Request $request)
    {

        try {
            $roledetails = $this->roleRepository->getRoleDetails($request);
            return $roledetails;
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
