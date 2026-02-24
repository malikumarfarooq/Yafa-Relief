<?php

namespace App\Livewire\Admin\Lists;

use App\Models\ProgramCategory;
use Livewire\Component;
use Livewire\WithPagination;

class ProgramCategoryList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $perPage = 10;

    public $selectedProgramCategories = [];

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
        $this->selectedProgramCategories = [];
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
            $this->selectedProgramCategories = ProgramCategory::query()
                ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%")
                )
                ->limit($this->perPage)
                ->pluck('id')
                ->toArray();
        } else {
            $this->selectedProgramCategories = [];
        }
    }

    public function render()
    {
        $programCategories = ProgramCategory::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%")
            )
            ->paginate($this->perPage);

        return view('livewire.admin.lists.program-category-list', [
            'programCategories' => $programCategories,
        ]);
    }
}
