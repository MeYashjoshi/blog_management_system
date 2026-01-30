<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $crudPermissions = ['create','view', 'edit', 'delete', 'status'];

        $modules = [
            'blog' => array_merge($crudPermissions,['request', 'approve', 'reject']),
            'category' =>$crudPermissions,
            'tag' => $crudPermissions,
            'rolesPermission' => $crudPermissions,
            'system' => ['dashboard','profile','setting'],
        ];

        $allPermissions = [];

        foreach ($modules as $module => $actions) {
            foreach ($actions as $action) {
                $allPermissions[] = [
                    'name' => "{$module}-{$action}",
                ];
            }
        }

        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate($permission);
        }


    }
}
