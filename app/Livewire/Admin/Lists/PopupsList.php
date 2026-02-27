<?php

namespace App\Livewire\Admin\Lists;

use App\Models\Popup;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class PopupsList extends Component
{
    use WithPagination;

    public $search         = '';
    public $filter         = false;
    public $perPage        = 10;
    public $selectedPopups = [];

    protected $queryString = ['search', 'perPage'];

    public function toggleFilter(): void
    {
        $this->filter = !$this->filter;
    }

    public function applyFilters(): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->search = '';
        $this->filter = false;
        $this->resetPage();
    }

    public function goToPage($page): void
    {
        $this->setPage($page);
    }

    public function toggleSelectAll($checked): void
    {
        $this->selectedPopups = $checked
            ? Popup::pluck('id')->toArray()
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
        $popups = Popup::whereIn('id', $this->selectedPopups)->get();
        foreach ($popups as $popup) {
            if ($popup->cover_image) Storage::disk('public')->delete($popup->cover_image);
            if ($popup->thumbnail)   Storage::disk('public')->delete($popup->thumbnail);
            $popup->delete();
        }
        $this->selectedPopups = [];
        session()->flash('success', 'Selected popups deleted!');
    }

    public function render()
    {
        $popups = Popup::where('title', 'like', '%' . $this->search . '%')
            ->orderBy('display_order')
            ->orderByDesc('created_at')
            ->paginate($this->perPage);

        return view('livewire.admin.lists.popups-list', compact('popups'))
            ->layout('components.admin.layout', [
                'tabTitle'   => 'Popup Management',
                'pageTitle'  => 'Popup Management',
                'breadcrumb' => 'Home ➔ Dashboard ➔ Popups',
            ]);
    }
}
