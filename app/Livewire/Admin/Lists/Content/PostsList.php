<?php

namespace App\Livewire\Admin\Lists\Content;

use App\Models\Posts;
use Livewire\Component;
use Livewire\WithPagination;

class PostsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $selectedPosts = [];
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
        $this->selectedPosts = [];
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
            $this->selectedPosts = Posts::query()
                ->when($this->search, fn ($q) =>
                    $q->where('title', 'like', "%{$this->search}%")
                )
                ->limit($this->perPage)
                ->pluck('id')
                ->toArray();
        } else {
            $this->selectedPosts = [];
        }
    }

    public function render()
    {
        $posts = Posts::query()
            ->when($this->search, fn ($q) =>
                $q->where('title', 'like', "%{$this->search}%")
            )
            ->paginate($this->perPage);

        return view('livewire.admin.lists.content.posts-list', [
            'posts' => $posts,
        ]);
    }
}
