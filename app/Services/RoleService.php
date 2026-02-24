<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{
    public function saveRole(array $data)
    {
        $role = Role::create([
            'name' => $data['name'],
            'guard_name' => 'web',
        ]);

        return $role;
    }

    public function updateRole(Role $role, array $data)
    {
        $role->update([
            'name' => $data['name'],
        ]);

        return $role;
    }

    public function deleteRole(Role $role)
    {
        $role->delete();
    }
}
