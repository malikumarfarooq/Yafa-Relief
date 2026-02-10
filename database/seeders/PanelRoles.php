<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PanelRoles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define panel roles
        $roles = [
            'admin',
            'editor',
            'finance',
        ];

        foreach ($roles as $role) {
            \Spatie\Permission\Models\Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }
    }
}
