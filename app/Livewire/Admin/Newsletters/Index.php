<?php

namespace App\Livewire\Admin\Newsletters;

use App\Models\Newsletter;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = '';

    // New properties for the redesigned table (added without disturbing core functionality)
    public bool $filter = false;
    public int $perPage = 20;
    public array $selectedSubscribers = [];

    // Your existing methods remain exactly the same
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function toggleStatus(int $id): void
    {
        $newsletter = Newsletter::findOrFail($id);
        $newStatus = $newsletter->status === 'subscribed' ? 'unsubscribed' : 'subscribed';
        $newsletter->update([
            'status' => $newStatus,
            $newStatus === 'subscribed' ? 'subscribed_at' : 'unsubscribed_at' => now(),
        ]);
        session()->flash('success', 'Subscriber status updated successfully.');
    }

    // New methods for UI functionality (added without affecting existing methods)
    public function toggleFilter(): void
    {
        $this->filter = !$this->filter;
    }

    public function applyFilters(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->reset(['search', 'status']);
        $this->filter = false;
        $this->resetPage();
    }

    public function toggleSelectAll($checked): void
    {
        if ($checked) {
            $this->selectedSubscribers = Newsletter::query()
                ->when($this->search, fn($q) => $q->where('email', 'like', '%' . $this->search . '%'))
                ->when($this->status, fn($q) => $q->where('status', $this->status))
                ->pluck('id')
                ->toArray();
        } else {
            $this->selectedSubscribers = [];
        }
    }

    // Pagination methods
    public function previousPage(): void
    {
        $this->setPage($this->getPage() - 1);
    }

    public function nextPage(): void
    {
        $this->setPage($this->getPage() + 1);
    }

    public function gotoPage($page): void
    {
        $this->setPage($page);
    }

    // Updated render method - only changed pagination to use $perPage
    public function render()
    {
        $subscribers = Newsletter::query()
            ->when($this->search, fn($q) => $q->where('email', 'like', '%' . $this->search . '%'))
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->latest()
            ->paginate($this->perPage); // Changed from hardcoded 20 to $this->perPage

        return view('livewire.admin.newsletters.index', compact('subscribers'));
    }
}
