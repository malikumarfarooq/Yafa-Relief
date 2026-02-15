<?php

namespace App\Livewire\Admin\Lists;

use Livewire\Component;
use App\Models\Donation;
use Livewire\WithPagination;

class DonationsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $selectedDonations = [];
    public $filter = false;

    // Filters
    public $paymentStatusFilter = '*';
    public $StartDateFilter;
    public $ToDateFilter;

    /**
     * Reset pagination when filters change
     */
    public function updatingSearch() { $this->resetPage(); }
    public function updatingPerPage() { $this->resetPage(); }
    public function updatingPaymentStatusFilter() { $this->resetPage(); }
    public function updatingStartDateFilter() { $this->resetPage(); }
    public function updatingToDateFilter() { $this->resetPage(); }

    public function toggleFilter()
    {
        $this->filter = !$this->filter;
    }

    public function resetFilters()
    {
        $this->reset([
            'search',
            'paymentStatusFilter',
            'StartDateFilter',
            'ToDateFilter',
            'selectedDonations'
        ]);

        $this->perPage = 10;
        $this->paymentStatusFilter = '*';
        $this->resetPage();
    }

    public function applyFilters()
    {
        $this->resetPage();
    }

    /**
     * Base filtered query (Reusable)
     */
    private function filteredQuery()
    {
        return Donation::query()
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('donation_number', 'like', "%{$this->search}%");

                });
            })
            ->when($this->paymentStatusFilter !== '*', function ($q) {
                $q->where('payment_status', $this->paymentStatusFilter);
            })
            ->when($this->StartDateFilter, function ($q) {
                $q->whereDate('created_at', '>=', $this->StartDateFilter);
            })
            ->when($this->ToDateFilter, function ($q) {
                $q->whereDate('created_at', '<=', $this->ToDateFilter);
            });
    }

    /**
     * Select / Deselect all visible rows (current page only)
     */
    public function toggleSelectAll($checked)
    {
        if ($checked) {
            $this->selectedDonations = $this->filteredQuery()
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage)
                ->pluck('id')
                ->toArray();
        } else {
            $this->selectedDonations = [];
        }
    }

    public function render()
    {
        $donations = $this->filteredQuery()
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.lists.donations-list', [
            'donations' => $donations,
        ]);
    }
}
