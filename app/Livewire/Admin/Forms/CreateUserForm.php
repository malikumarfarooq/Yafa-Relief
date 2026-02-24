<?php

namespace App\Livewire\Admin\Forms;

use App\Models\Role;
use App\Services\UserService;
use Livewire\Component;

class CreateUserForm extends Component
{
    // Form fields
    public $f_name;

    public $l_name;

    public $email;

    public $password;

    public $phone;

    public $role;

    public $is_active = 0;

    public $roles = [];

    public function mount()
    {
        $this->roles = Role::all();
    }

    protected $rules = [
        'f_name' => 'required|string|max:255',
        'l_name' => 'nullable|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'phone' => 'nullable|string|max:20',
        'role' => 'required',
        'is_active' => 'required',
    ];

    public function save(UserService $userService)
    {
        $validated = $this->validate();

        $userService->createUser($validated);

        $this->reset();

        session()->flash('success', 'User created successfully.');
    }

    public function render()
    {
        return view('admin.forms.create-user-form');
    }
}
