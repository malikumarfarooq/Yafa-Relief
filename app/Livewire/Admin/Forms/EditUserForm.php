<?php

namespace App\Livewire\Admin\Forms;

use App\Models\User;
use App\Models\Role;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Services\UserService;

class EditUserForm extends Component
{
    public User $user;

    // Form fields
    public $f_name;
    public $l_name;
    public $email;
    public $password;
    public $phone;
    public $role;
    public $is_active;

    public $roles = [];

    public function mount(User $user)
    {
        $this->user = $user;

        // Load roles
        $this->roles = Role::all();

        // Prefill fields
        $this->f_name   = $user->f_name;
        $this->l_name   = $user->l_name;
        $this->email    = $user->email;
        $this->phone    = $user->phone;
        $this->is_active = $user->is_active ? 1 : 0;

        // Spatie role (single role)
        $this->role = $user->roles->first()?->name;
    }

    protected function rules()
    {
        return [
            'f_name'   => 'required|string|max:255',
            'l_name'   => 'nullable|string|max:255',
            'email'    => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user->id),
            ],
            'password' => 'nullable|min:8',
            'phone'    => 'nullable|string|max:20',
            'role'     => 'required',
            'is_active'=> 'required|boolean',
        ];
    }

    public function update(UserService $userService)
    {
        $validated = $this->validate();

        $userService->updateUser($this->user, $validated);

        // Sync role (Spatie)
        $this->user->syncRoles([$this->role]);

        session()->flash('success', 'User updated successfully.');
    }

    public function render()
    {
        return view('admin.forms.edit-user-form');
    }
}
