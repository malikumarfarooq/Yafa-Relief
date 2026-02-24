<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User Management Permissions
            ['name' => 'user-list', 'group' => 'User Management', 'title' => 'List Users', 'description' => 'Permission to list users'],
            ['name' => 'user-create', 'group' => 'User Management', 'title' => 'Create User', 'description' => 'Permission to create users'],
            ['name' => 'user-edit', 'group' => 'User Management', 'title' => 'Edit User', 'description' => 'Permission to edit users'],
            ['name' => 'user-delete', 'group' => 'User Management', 'title' => 'Delete User', 'description' => 'Permission to delete users'],
            // Role Management Permissions
            ['name' => 'role-list', 'group' => 'Role Management', 'title' => 'List Roles', 'description' => 'Permission to list roles'],
            ['name' => 'role-create', 'group' => 'Role Management', 'title' => 'Create Role', 'description' => 'Permission to create roles'],
            ['name' => 'role-edit', 'group' => 'Role Management', 'title' => 'Edit Role', 'description' => 'Permission to edit roles'],
            ['name' => 'role-delete', 'group' => 'Role Management', 'title' => 'Delete Role', 'description' => 'Permission to delete roles'],
            // Settings Management Permissions
            ['name' => 'settings-edit', 'group' => 'Settings Management', 'title' => 'Edit Settings', 'description' => 'Permission to edit system settings'],
            // Dashboard Access Permissions
            ['name' => 'dashboard-access', 'group' => 'Dashboard Access', 'title' => 'Access Dashboard', 'description' => 'Permission to access the dashboard'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate($permission + ['guard_name' => 'web']);
        }

        // Create roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'Owner', 'description' => 'System Owner Role', 'guard_name' => 'web', 'is_deletable' => false]);
        $adminRole->syncPermissions(Permission::all());

        $userRole = Role::firstOrCreate(['name' => 'Admin', 'description' => 'Administrator Role', 'guard_name' => 'web', 'is_deletable' => true]);
        $userRole->syncPermissions(['user-list']);

        // Create admin user with enhanced fields
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'f_name' => 'Salam',
                'l_name' => 'Aslam',
                'password' => bcrypt('password'),
                'is_active' => true,
                'mfa_enabled' => false,
                'is_deletable' => false,
                'user_type' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        if (! $admin->hasRole('Owner')) {
            $admin->assignRole('Owner');
        }
    }
}
