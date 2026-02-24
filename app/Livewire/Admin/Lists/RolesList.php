<?php

namespace App\Livewire\Admin\Lists;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class RolesList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $perPage = 10;

    public $selectedRoles = [];

    public $filter = false;

    /**
     * Reset pagination when filters change
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
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
        $this->perPage = 10;
        $this->selectedRoles = [];
        $this->resetPage();
    }

    public function applyFilters()
    {
        $this->resetPage();
    }

    /**
     * Select / Deselect all visible roles
     */
    public function toggleSelectAll($checked)
    {
        if ($checked) {
            $this->selectedRoles = Role::query()
                ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%")
                )
                ->limit($this->perPage)
                ->pluck('id')
                ->toArray();
        } else {
            $this->selectedRoles = [];
        }
    }

    public function render()
    {
        $roles = Role::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%")
            )
            ->paginate($this->perPage);

        return view('livewire.admin.lists.roles-list', [
            'roles' => $roles,
        ]);
    }
}
