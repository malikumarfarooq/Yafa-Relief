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

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingStatus(): void { $this->resetPage(); }

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

    public function render()
    {
        $subscribers = Newsletter::query()
            ->when($this->search, fn($q) => $q->where('email', 'like', '%' . $this->search . '%'))
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->latest()
            ->paginate(20);

        return view('livewire.admin.newsletters.index', compact('subscribers'));
    }
}