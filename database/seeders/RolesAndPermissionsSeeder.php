<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define modules and CRUD-style actions
        $modules = [
            'admin-panel',
            'certificate-management',
            'student-card-management',
        ];

        $actions = ['create', 'view', 'update', 'delete'];

        // Create permissions
        foreach ($modules as $module) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "$action:$module"]);
            }
        }

        // Create admin role and assign all permissions
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(Permission::all());

        // Optionally assign role to a specific user
        $adminUser = User::where('name', 'admin')->first();
        if ($adminUser && !$adminUser->hasRole('admin')) {
            $adminUser->assignRole($admin);
        }
    }
}
