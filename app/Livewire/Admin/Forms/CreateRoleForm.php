<?php

namespace App\Livewire\Admin\Forms;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRoleForm extends Component
{
    public $name;

    public $description = '';

    public $permissions = [];

    public $allPermissions = [];

    protected $rules = [
        'name' => 'required|string|max:255|unique:roles,name',
        'permissions' => 'array',
        'description' => 'nullable|string',
    ];

    public function mount()
    {
        $this->allPermissions = Permission::all();
    }

    public function submit()
    {
        $this->validate();

        $role = Role::create([
            'name' => $this->name,
            'guard_name' => 'web',
            'description' => $this->description,
        ]);

        if (! empty($this->permissions)) {
            $role->syncPermissions($this->permissions);
        }

        $this->reset(['name', 'description', 'permissions']);

        session()->flash('success', 'Role created successfully.');
    }

    public function render()
    {
        return view('livewire.admin.forms.create-role-form');
    }
}
