<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use Exception;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{

    protected Role $roleModel;
    protected Permission $permissionModel;

    public function __construct(Role $roleModel, Permission $permissionModel)
    {
        $this->roleModel = $roleModel;
        $this->permissionModel = $permissionModel;
    }

    public function getRoles() {}

    public function getRolesAndPermissions()
    {
        try {

            $roles = $this->roleModel->with('permissions')->get();
            $rolesWithPermissions = $roles->map(function ($role) {

                return [
                    'name' => Str::headline($role->name),
                    'permissions' => $role->permissions
                        ->groupBy(function ($permission) {
                            $modulename = explode('-', $permission->name)[0];
                            return Str::headline($modulename);
                        })
                        ->keys()
                        ->toArray(),
                    'id' => $role->id,

                ];
            });

            return $rolesWithPermissions;
        } catch (Exception $e) {
            throw new Exception("Failed to get roles and permissions: " . $e->getMessage());
        }
    }

    public function getModulesAndPermissions()
    {
        try {

            $permissions = $this->permissionModel->all();
            $modules = $permissions->groupBy(function ($permission) {
                $modulename = explode('-', $permission->name)[0];
                return Str::headline($modulename);
            })
                ->map(function ($group) {
                    return $group->map(function ($permission) {
                        return [
                            'name' => str::headline(explode('-', $permission->name)[1]),
                            'id' => $permission->id,
                        ];
                    })->values()->toArray();
                })

                ->toArray();

            return $modules;
        } catch (Exception $e) {
            throw new Exception("Failed to get modules: " . $e->getMessage());
        }
    }

    public function getRoleDetails($request)
    {
        try {
            $role = $this->roleModel
                ->with('permissions')
                ->findOrFail($request->role_id);

            $roleDetails = [
                Str::headline($role->name) =>
                $role->permissions
                    ->groupBy(function ($permission) {
                        return Str::headline(
                            explode('-', $permission->name)[0]
                        );
                    })
                    ->map(function ($group) {
                        return $group->map(function ($permission) {
                            return [
                                'name' => str::headline(explode('-', $permission->name)[1]),
                                'id' => $permission->id,
                            ];
                        })->values()->toArray();
                    })
                    ->toArray()
            ];

            return $roleDetails;
        } catch (Exception $e) {
            dd($e->getMessage());
            throw new Exception("Failed to get role details: " . $e->getMessage());
        }
    }

    public function manageRole($request) {}

    public function deleteRole($request) {}
}
