<?php

namespace App\Livewire\Admin\Forms;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

class EditRoleForm extends Component
{
    public Role $role;

    public $name;
    public $description = '';
    public $permissions = [];
    public $users;

    public $allPermissions = [];

    public function mount(Role $role)
    {
        $this->role = $role;

        // Prefill fields
        $this->name = $role->name;
        $this->description = $role->description;

        // Current permissions (names)
        $this->permissions = $role->permissions->pluck('name')->toArray();

        // All available permissions
        $this->allPermissions = Permission::all();
        // Users with this role
        $this->users = $role->users()->select('id', 'f_name', 'l_name', 'email')->get();
    }
    public function delete()
    {
        if (!$this->role->is_deletable) {
            session()->flash('error', 'This role cannot be deleted.');
            return;
        }
        // Safety check
        if ($this->role->users()->count() > 0) {
            session()->flash('error', 'This role cannot be deleted because users are assigned to it.');
            return;
        }

        // Detach permissions first (good practice)
        $this->role->syncPermissions([]);

        // Delete role
        $this->role->delete();

        // Redirect after delete
        return redirect()->to('/admin/settings/roles', 302)->with('success', 'Role deleted successfully.');
    }

    protected function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')->ignore($this->role->id),
            ],
            'permissions' => 'array',
            'description' => 'nullable|string',
        ];
    }

    public function update()
    {
        $this->validate();

        // Update role
        $this->role->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        // Sync permissions
        $this->role->syncPermissions($this->permissions);

        session()->flash('success', 'Role updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.forms.edit-role-form');
    }
}
