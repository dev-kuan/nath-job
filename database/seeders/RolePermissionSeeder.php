<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //;
        
        $permissions = [
            'manage categories',
            'manage company',
            'manage jobs',
            'manage candidates',
            'apply job',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }

        $employerRole = Role::firstOrCreate([
            'name' => 'employer',
        ]);

        $employerPermissions = [
            'manage candidates',
            'manage company',
            'manage jobs',
        ];

        $employerRole->syncPermissions($employerPermissions);
        
        $employeeRole = Role::firstOrCreate([
            'name' => 'employee',
        ]);

        $employeePermissions = [
            'apply job',
        ];

        $employeeRole->syncPermissions($employeePermissions);

        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin',
        ]);

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@mail.com',
            'occupation' => 'Superadmin',
            'experience' => 100,
            'avatar' => 'images/default-avatar.png',
            'password' => bcrypt('admin1234'),
        ]);

        $user->assignRole($superAdminRole);
    }
}
