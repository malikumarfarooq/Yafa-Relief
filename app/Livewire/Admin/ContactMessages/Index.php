<?php

namespace App\Livewire\Admin\ContactMessages;

use App\Models\ContactMessage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = '';
    public string $date = '';
    public bool $filter = false;
    public int $perPage = 20;
    public array $selectedMessages = [];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function updatingDate(): void
    {
        $this->resetPage();
    }

    // Add toggleFilter method
    public function toggleFilter(): void
    {
        $this->filter = !$this->filter;
    }

    // Add applyFilters method
    public function applyFilters(): void
    {
        $this->resetPage();
    }

    // Add toggleSelectAll method for checkbox functionality
    public function toggleSelectAll($checked): void
    {
        if ($checked) {
            $this->selectedMessages = ContactMessage::query()
                ->when($this->search, function ($q) {
                    $q->where(function ($q) {
                        $q->where('first_name', 'like', '%' . $this->search . '%')
                            ->orWhere('last_name', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%')
                            ->orWhere('subject', 'like', '%' . $this->search . '%');
                    });
                })
                ->when($this->status, fn($q) => $q->where('status', $this->status))
                ->when($this->date, fn($q) => $q->whereDate('created_at', $this->date))
                ->pluck('id')
                ->toArray();
        } else {
            $this->selectedMessages = [];
        }
    }

    public function updateStatus(int $id, string $status): void
    {
        ContactMessage::findOrFail($id)->update(['status' => $status]);
        session()->flash('success', 'Status updated successfully.');
    }

    public function delete(int $id): void
    {
        ContactMessage::findOrFail($id)->delete();
        session()->flash('success', 'Message deleted successfully.');
    }

    public function clearFilters(): void
    {
        $this->search = '';
        $this->status = '';
        $this->date = '';
        $this->filter = false; // Also close the filter section
        $this->resetPage();
    }

    // Add pagination methods
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

    public function render()
    {
        $messages = ContactMessage::query()
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('subject', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->when($this->date, fn($q) => $q->whereDate('created_at', $this->date))
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.admin.contact-messages.index', compact('messages'));
    }
}
