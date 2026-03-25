<?php

namespace App\Livewire\Admin\Lists;

use App\Models\Donation;
use Livewire\Component;
use Livewire\WithPagination;

class DonorsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $perPage = 10;

    public $selectedDonors = [];

    public $filter = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function toggleFilter()
    {
        $this->filter = ! $this->filter;
    }

    public function resetFilters()
    {
        $this->reset([
            'search',
        ]);

        $this->perPage = 10;
        $this->resetPage();
    }

    public function applyFilters()
    {
        $this->resetPage();
    }

    public function toggleSelectAll($checked)
    {
        if ($checked) {
            $this->selectedDonors = Donation::query()
                ->when($this->search, function ($q) {
                    $q->where(function ($query) {
                        $query->where('email', 'like', "%{$this->search}%");
                    });
                })
                ->distinct()
                ->pluck('email')
                ->toArray();
        } else {
            $this->selectedDonors = [];
        }
    }

    /**
     * Base filtered query (Reusable)
     */
    private function filteredQuery()
    {
        return Donation::query()
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('email', 'like', "%{$this->search}%");
                });
            })->selectRaw('
            email,
            COUNT(id) as total_donations,
            SUM(total_amount) as total_donation_amount
        ')
            ->groupBy('email')
            ->orderByDesc('total_donations');
    }

    /**
     * Select / Deselect all visible rows (current page only)
     */
    public function render()
    {
        $donors = Donation::query()
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('email', 'like', "%{$this->search}%");
                });
            })
            ->selectRaw('
            email,
            COUNT(id) as total_donations,
            SUM(total_amount) as total_donation_amount
        ')
            ->groupBy('email')
            ->orderByDesc('total_donations')
            ->paginate($this->perPage);

        return view('livewire.admin.lists.donors-list', compact('donors'));
    }
}
