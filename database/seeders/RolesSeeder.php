<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);
        $userRole = Role::firstOrCreate(['name' => 'user']);


        $allPermissions = Permission::all();
        $adminRole->syncPermissions($allPermissions);

        $editorPermissions = ['blog-create', 'blog-view', 'blog-edit', 'blog-status', 'category-view', 'category-create', 'category-delete', 'tag-view', 'tag-create', 'tag-delete','system-profile'];

        $editorRole->syncPermissions(
            Permission::whereIn('name', $editorPermissions)->pluck('name')
        );

        $userPermissions = ['blog-create', 'blog-view', 'blog-edit','blog-delete','blog-status','system-profile'];
        $userRole->syncPermissions(
            Permission::whereIn('name', $userPermissions)->pluck('name')
        );


    }
}
