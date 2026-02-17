<?php

namespace App\Livewire\Admin\Lists\Content;

use App\Models\Stories;
use Livewire\Component;
use Livewire\WithPagination;

class StoriesList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $selectedStories = [];
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
        $this->selectedStories = [];
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
            $this->selectedStories = Stories::query()
                ->when($this->search, fn ($q) =>
                    $q->where('title', 'like', "%{$this->search}%")
                )
                ->limit($this->perPage)
                ->pluck('id')
                ->toArray();
        } else {
            $this->selectedStories = [];
        }
    }

    public function render()
    {
        $stories = Stories::query()
            ->when($this->search, fn ($q) =>
                $q->where('title', 'like', "%{$this->search}%")
            )
            ->paginate($this->perPage);

        return view('livewire.admin.lists.content.stories-list', [
            'stories' => $stories,
        ]);
    }
}
