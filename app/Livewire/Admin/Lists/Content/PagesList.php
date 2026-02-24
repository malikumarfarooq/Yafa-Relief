<?php

namespace App\Livewire\Admin\Lists\Content;

use App\Models\Pages;
use Livewire\Component;
use Livewire\WithPagination;

class PagesList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $perPage = 10;

    public $selectedPages = [];

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
        $this->selectedPages = [];
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
            $this->selectedPages = Pages::query()
                ->when($this->search, fn ($q) => $q->where('title', 'like', "%{$this->search}%")
                )
                ->limit($this->perPage)
                ->pluck('id')
                ->toArray();
        } else {
            $this->selectedPages = [];
        }
    }

    public function render()
    {
        $pages = Pages::query()
            ->when($this->search, fn ($q) => $q->where('title', 'like', "%{$this->search}%")
            )
            ->paginate($this->perPage);

        return view('livewire.admin.lists.content.pages-list', [
            'pages' => $pages,
        ]);
    }
}
