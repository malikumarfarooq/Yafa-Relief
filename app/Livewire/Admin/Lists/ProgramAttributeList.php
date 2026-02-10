<?php

namespace App\Livewire\Admin\Lists;

use App\Models\ProgramAttribute;
use Livewire\Component;
use Livewire\WithPagination;

class ProgramAttributeList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $selectedProgramAttributes = [];
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
        $this->filter = !$this->filter;
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->perPage = 10;
        $this->selectedProgramAttributes = [];
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
            $this->selectedProgramAttributes = ProgramAttribute::query()
                ->when($this->search, fn ($q) =>
                    $q->where('name', 'like', "%{$this->search}%")
                )
                ->limit($this->perPage)
                ->pluck('id')
                ->toArray();
        } else {
            $this->selectedProgramAttributes = [];
        }
    }

    public function render()
    {
        $programAttributes = ProgramAttribute::query()
            ->when($this->search, fn ($q) =>
                $q->where('name', 'like', "%{$this->search}%")
            )
            ->paginate($this->perPage);

        return view('livewire.admin.lists.program-attribute-list', [
            'programAttributes' => $programAttributes,
        ]);
    }
}
