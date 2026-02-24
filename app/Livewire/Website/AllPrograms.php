<?php

namespace App\Livewire\Website;

use App\Models\Program;
use App\Models\ProgramCategory;
use Livewire\Component;
use Livewire\WithPagination;

class AllPrograms extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $filter = 'all';

    public $perPage = 6;

    protected $queryString = ['filter'];

    public function updatedFilter()
    {
        $this->resetPage();
    }

    public function loadMore()
    {
        $this->perPage += 6;
    }

    public function render()
    {
        $query = Program::query()
            ->where('is_active', true)
            ->whereNull('deleted_at');

        if ($this->filter !== 'all') {
            $category = ProgramCategory::where('slug', $this->filter)->first();

            if ($category) {
                $query->whereJsonContains(
                    'associated_category_ids',
                    (string) $category->id
                );
            }
        }

        $categories = ProgramCategory::all()->map(function ($category) {
            $count = Program::where('is_active', true)
                ->whereJsonContains(
                    'associated_category_ids',
                    (string) $category->id
                )->count();

            $category->programs_count = $count;

            return $category;
        });

        return view('livewire.website.all-programs', [
            'programs' => $query->latest()->paginate($this->perPage),
            'categories' => $categories,
            'totalCount' => Program::where('is_active', true)->count(),
        ]);
    }
}
