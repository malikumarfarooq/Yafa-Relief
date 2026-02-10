<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $data): User
    {
        $user = User::create([
            'f_name'    => $data['f_name'],
            'l_name'    => $data['l_name'] ?? null,
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            'phone'     => $data['phone'] ?? null,
            'is_active' => $data['is_active'],
            'user_type' => 'admin',
        ]);
        $user->assignRole($data['role']);
        return $user;
    }
    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);

        if (!$user->is_deletable) {
            return false;
        }

        $user->delete();

        return true;
    }
    public function updateUser(User $user, array $data): User
    {
        $user->update([
            'f_name'    => $data['f_name'],
            'l_name'    => $data['l_name'] ?? null,
            'email'     => $data['email'],
            'phone'     => $data['phone'] ?? null,
            'is_active' => $data['is_active'],
        ]);

        if (!empty($data['password'])) {
            $user->update(['password' => Hash::make($data['password'])]);
        }

        // Sync role
        if (!empty($data['role'])) {
            $user->syncRoles([$data['role']]);
        }

        return $user;
    }
}
