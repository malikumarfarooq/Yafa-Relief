<?php

namespace App\Livewire\Admin\Lists\Content;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class NewsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $perPage = 10;

    public $selectedNews = [];

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
        $this->selectedNews = [];
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
            $this->selectedNews = News::query()
                ->when($this->search, fn ($q) => $q->where('title', 'like', "%{$this->search}%")
                )
                ->limit($this->perPage)
                ->pluck('id')
                ->toArray();
        } else {
            $this->selectedNews = [];
        }
    }

    public function render()
    {
        $news = News::query()
            ->when($this->search, fn ($q) => $q->where('title', 'like', "%{$this->search}%")
            )
            ->paginate($this->perPage);

        return view('livewire.admin.lists.content.news-list', [
            'news' => $news,
        ]);
    }
}
