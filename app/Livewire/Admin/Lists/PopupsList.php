<?php

namespace App\Livewire\Admin\Lists;

use App\Models\Popup;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class PopupsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search         = '';
    public $perPage        = 10;
    public $selectedPopups = [];
    public $filter         = false;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }
    public function updatingPerPage(): void
    {
        $this->resetPage();
    }
    public function toggleFilter(): void
    {
        $this->filter = !$this->filter;
    }

    public function resetFilters(): void
    {
        $this->search         = '';
        $this->perPage        = 10;
        $this->selectedPopups = [];
        $this->resetPage();
    }

    public function applyFilters(): void
    {
        $this->resetPage();
    }

    public function toggleSelectAll($checked): void
    {
        $this->selectedPopups = $checked
            ? Popup::when(
                $this->search,
                fn($q) => $q->where('title', 'like', "%{$this->search}%")
            )
            ->limit($this->perPage)->pluck('id')->toArray()
            : [];
    }

    public function toggleActive($id): void
    {
        $popup = Popup::find($id);
        if ($popup) {
            $popup->update(['is_active' => !$popup->is_active]);
            session()->flash('success', 'Popup status updated!');
        }
    }

    public function delete($id): void
    {
        $popup = Popup::find($id);
        if ($popup) {
            if ($popup->cover_image) Storage::disk('public')->delete($popup->cover_image);
            if ($popup->thumbnail)   Storage::disk('public')->delete($popup->thumbnail);
            $popup->delete();
            session()->flash('success', 'Popup deleted!');
        }
    }

    public function deleteSelected(): void
    {
        foreach (Popup::whereIn('id', $this->selectedPopups)->get() as $p) {
            if ($p->cover_image) Storage::disk('public')->delete($p->cover_image);
            if ($p->thumbnail)   Storage::disk('public')->delete($p->thumbnail);
            $p->delete();
        }
        $this->selectedPopups = [];
        session()->flash('success', 'Selected popups deleted!');
    }

    public function render()
    {
        $popups = Popup::when(
            $this->search,
            fn($q) => $q->where('title', 'like', "%{$this->search}%")
        )
            ->orderBy('display_order')
            ->orderByDesc('created_at')
            ->paginate($this->perPage);

        return view('livewire.admin.lists.popups-list', compact('popups'));
    }
}
