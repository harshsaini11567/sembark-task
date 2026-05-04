<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // reset cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // permissions
        $permissions = [
            'create url',
            'view all urls',
            'view company urls',
            'view own urls'
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm], ['guard_name' => 'web']);
        }

        // roles
        $super = Role::firstOrCreate(['name' => 'SuperAdmin'], ['guard_name' => 'web']);
        $admin = Role::firstOrCreate(['name' => 'Admin'], ['guard_name' => 'web']);
        $member = Role::firstOrCreate(['name' => 'Member'], ['guard_name' => 'web']);

        // assign permissions
        $super->syncPermissions(['view all urls']);
        $admin->syncPermissions(['create url', 'view company urls']);
        $member->syncPermissions(['create url', 'view own urls']);
    }
}