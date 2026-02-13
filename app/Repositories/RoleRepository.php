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

            $modules = $permissions
                ->groupBy(function ($permission) {
                    return Str::headline(explode('-', $permission->name)[0]);
                })
                ->map(function ($group) {
                    return $group->map(function ($permission) {
                        return [
                            'name' => Str::headline(explode('-', $permission->name)[1]),
                            'id' => $permission->id,
                            'assigned' => false // important
                        ];
                    })->values()->toArray();
                })
                ->toArray();

            return [
                'role_name' => null,
                'modules' => $modules,
            ];
        } catch (Exception $e) {
            throw new Exception("Failed to get modules: " . $e->getMessage());
        }
    }

    public function getRoleDetails($request)
    {
        try {
            $role = $this->roleModel->with('permissions')->findOrFail($request->role_id);

            $allPermissions = $this->permissionModel->all();

            $assignedPermissionIds = $role->permissions->pluck('id')->toArray();

            $modules = $allPermissions
                ->groupBy(function ($permission) {
                    return Str::headline(explode('-', $permission->name)[0]);
                })
                ->map(function ($group) use ($assignedPermissionIds) {
                    return $group->map(function ($permission) use ($assignedPermissionIds) {
                        return [
                            'name' => Str::headline(explode('-', $permission->name)[1]),
                            'id' => $permission->id,
                            'assigned' => in_array($permission->id, $assignedPermissionIds),
                        ];
                    })->values()->toArray();
                })
                ->toArray();

            return [
                'role_name' => Str::headline($role->name),
                'role_id' => $role->id,
                'modules'   => $modules,
            ];
        } catch (Exception $e) {
            throw new Exception("Failed to get role details: " . $e->getMessage());
        }
    }

    public function manageRole($request)
    {
        // dd($request);
        try {
            $role = $this->roleModel->updateOrCreate(
                ['id' => $request->role_id],
                ['name' => Str::slug($request->role_name)]
            );

            $role->syncPermissions(
                Permission::whereIn('id', $request->permissions)->pluck('name')
            );

            if ($role->wasRecentlyCreated) {
                return 201;
            }

            return 200;
        } catch (Exception $e) {
            dd($e->getMessage());
            throw new Exception("Failed to manage role: " . $e->getMessage());
        }
    }

    public function deleteRole($request)
    {
        try {
            $role = $this->roleModel->findOrFail($request->role_id);
            $role->delete();
            return true;
        } catch (Exception $e) {
            throw new Exception("Failed to delete role: " . $e->getMessage());
        }
    }
}
