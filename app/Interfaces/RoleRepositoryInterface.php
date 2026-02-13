<?php

namespace App\Interfaces;

interface RoleRepositoryInterface
{
    public function getRolesAndPermissions();
    public function getModulesAndPermissions();
    public function getRoleDetails($request);
    public function manageRole($request);
    public function deleteRole($request);
}
