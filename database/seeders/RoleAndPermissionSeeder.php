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
        $super_admin = Role::create(['name' => 'super_admin', 'guard_name' => 'web']);

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
            'delete permission' .
            'view dashboard',
            'view settings',
            'manage setting',
        ];

        foreach ($s_permissions as $permission) {
            $p = Permission::create(['name' => $permission, 'guard_name' => 'web']);
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

        $owner = Role::create(['name' => 'owner', 'guard_name' => 'web']);

        foreach ($o_permissions as $permission) {
            $p = Permission::updateOrCreate(['name' => $permission], ['name' => $permission, 'guard_name' => 'web']);
            $owner->givePermissionTo($p);
        }

        $owner->givePermissionTo($permission);

        // Driver
        $d_permissions = [
            'read order',
            'edit order',
            'cancel order'
        ];

        $driver = Role::create(['name' => 'driver', 'guard_name' => 'web']);

        foreach ($d_permissions as $permission) {
            $p = Permission::updateOrCreate(['name' => $permission], ['name' => $permission, 'guard_name' => 'web']);
            $driver->givePermissionTo($p);
        }

        $driver->givePermissionTo($permission);

        // Refiller
        $r_permissions = [
            'read order',
            'edit order'
        ];

        $refiller = Role::create(['name' => 'refiller', 'guard_name' => 'web']);

        foreach ($r_permissions as $permission) {
            $p = Permission::updateOrCreate(['name' => $permission], ['name' => $permission, 'guard_name' => 'web']);
            $refiller->givePermissionTo($p);
        }

        $refiller->givePermissionTo($permission);

        // Customer
        $c_permissions = [
            'read order',
            'create order',
            'update order',
            'checkout order',
            'cancel order'
        ];

        $customer = Role::create(['name' => 'customer', 'guard_name' => 'web']);

        foreach ($c_permissions as $permission)
        {
            $p = Permission::updateOrCreate(['name' => $permission], ['name' => $permission, 'guard_name' => 'web']);
            $customer->givePermissionTo($p);
        }
    }
}
