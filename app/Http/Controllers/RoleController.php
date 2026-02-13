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

            return view('dashboard.rolesandpermissions', compact('RolesAndPermissions'));
        } catch (Exception $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function getModulesAndPermissions()
    {
        try {
            $ModulesAndPermissions = $this->roleRepository->getModulesAndPermissions();
            return response()->json($ModulesAndPermissions);
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
            return response()->json($roledetails);
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function manageRole(Request $request)
    {
        try {
            $res = $this->roleRepository->manageRole($request);
            if ($res === 200) {
                return back()->with('success', 'Role updated successfully');
            } else if ($res === 201) {
                return back()->with('success', 'Role created successfully');
            }
        } catch (\Throwable $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function deleteRole(Request $request)
    {
        try {
            $res = $this->roleRepository->deleteRole($request);
            return back()->with('success', 'Role deleted successfully');
        } catch (Exception $e) {
            return back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
