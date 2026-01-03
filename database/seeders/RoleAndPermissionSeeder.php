<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admin = Role::create(['name' => 'super_admin']);

        $permissions = [
            'manage_users',
            'manage_roles',
            'manage_permissions',
            'view_dashboard',
            'view_settings',
            'manage_settings',
        ];

        foreach ($permissions as $permission) {
            $p = Permission::create(['name' => $permission]);
            $super_admin->givePermissionTo($p);
        }
    }
}
