<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // your custom path
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('Superadmin@1234'),
                'remember_token' => null,
                'email_verified_at' => now(),
                // 'approval_status' => 1,
                'role' => 'SuperAdmin'
            ]
        ];

        foreach ($users as $data) {

            // separate role from user data
            $roleName = $data['role'];
            unset($data['role']);

            // create or update user
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                $data
            );

            // get role
            $role = Role::firstOrCreate(['name' => $roleName]);

            // assign role safely
            if (!$user->hasRole($roleName)) {
                $user->assignRole($role);
            }
        }
    }
}