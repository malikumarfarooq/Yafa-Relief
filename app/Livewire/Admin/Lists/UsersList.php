<?php

namespace App\Livewire\Admin\Lists;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role; // use this for roles

class UsersList extends Component
{
    use WithPagination;

    public $roles;

    public $search = '';

    public $roleFilter = '*';

    public $perPage = 10;

    public $selectedUsers = [];

    public $filter = false;

    public $page = 1; // current page for custom pagination

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        // Load all roles from DB
        $this->roles = Role::all();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingRoleFilter()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function toggleFilter()
    {
        $this->filter = ! $this->filter;
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->roleFilter = '*';
        $this->perPage = 10;
        $this->selectedUsers = [];
        $this->resetPage();
    }

    public function toggleSelectAll($value)
    {
        if ($value) {
            $this->selectedUsers = User::query()
                ->when($this->roleFilter != '*', fn ($q) => $q->role($this->roleFilter))
                ->when($this->search, fn ($q) => $q->where(function ($q) {
                    $q->where('f_name', 'like', "%{$this->search}%")
                        ->orWhere('l_name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%");
                }))
                ->where('user_type', 'admin') // only select admin users
                ->pluck('id')
                ->toArray();
        } else {
            $this->selectedUsers = [];
        }
    }

    public function goToPage($page)
    {
        $this->page = $page;
    }

    public function applyFilters()
    {
        $this->resetPage();
    }

    public function render()
    {
        $usersQuery = User::query()
            ->with('roles') // <<< important, eager load roles!
            ->when($this->roleFilter != '*', fn ($q) => $q->role($this->roleFilter))
            ->where('user_type', 'admin')
            ->when($this->search, fn ($q) => $q->where(function ($q) {
                $q->where('f_name', 'like', "%{$this->search}%")
                    ->orWhere('l_name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%");
            }));

        $users = $usersQuery->paginate($this->perPage, ['*'], 'page', $this->page);

        return view('livewire.admin.lists.users-list', [
            'users' => $users,
        ]);
    }
}
