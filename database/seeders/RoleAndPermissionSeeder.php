<?php

namespace Database\Seeders;

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

        $s_permissions = [
            'read user',
            'create user',
            'edit user',
            'delete user',
            'read role',
            'create role',
            'edit role',
            'delete role',
            'create permission',
            'edit permission',
            'delete permission'.
            'view dashboard',
            'view settings',
            'manage setting',
        ];

        foreach ($s_permissions as $permission) {
            $p = Permission::create(['name' => $permission]);
            $super_admin->givePermissionTo($p);
        }

        // Owner
        $o_permissions = [
            'read station',
            'create station',
            'edit station',
            'delete station',
            'read staff',
            'create staff',
            'edit staff',
            'delete staff',
            'read station product',
            'create station product',
            'edit station product',
            'delete station product',
            'read subscription',
            'create subscription',
            'edit subscription',
            'read order',
            'cancel order',
            'delete order'
        ];

        $owner = Role::create(['name' => 'owner']);

        foreach ($o_permissions as $permission) {
            $p = Permission::updateOrCreate(['name' => $permission], ['name' => $permission]);
            $owner->givePermissionTo($p);
        }

        $owner->givePermissionTo($permission);

        // Driver
        $d_permissions = [
            'read order',
            'edit order',
            'cancel order'
        ];

        $driver = Role::create(['name' => 'driver']);

        foreach ($d_permissions as $permission) {
            $p = Permission::updateOrCreate(['name' => $permission], ['name' => $permission]);
            $driver->givePermissionTo($p);
        }

        $driver->givePermissionTo($permission);

        // Refiller
        $r_permissions = [
            'read order',
            'edit order'
        ];

        $refiller = Role::create(['name' => 'refiller']);

        foreach ($r_permissions as $permission) {
            $p = Permission::updateOrCreate(['name' => $permission], ['name' => $permission]);
            $refiller->givePermissionTo($p);
        }

        $refiller->givePermissionTo($permission);
    }
}
