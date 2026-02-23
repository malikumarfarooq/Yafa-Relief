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
    public string $date   = '';

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingStatus(): void { $this->resetPage(); }
    public function updatingDate(): void   { $this->resetPage(); }

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
        $this->date   = '';
        $this->resetPage();
    }

    public function render()
    {
        $messages = ContactMessage::query()
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('last_name',  'like', '%' . $this->search . '%')
                      ->orWhere('email',      'like', '%' . $this->search . '%')
                      ->orWhere('subject',    'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->when($this->date,   fn($q) => $q->whereDate('created_at', $this->date))
            ->latest()
            ->paginate(20);

        return view('livewire.admin.contact-messages.index', compact('messages'));
    }
}