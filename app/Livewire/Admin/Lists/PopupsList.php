<?php

namespace App\Livewire\Admin\Lists;

use App\Models\Popup;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class PopupsList extends Component
{
    use WithPagination;

    public $search = '';
    public $filter = false;
    public $perPage = 10;
    public $selectedPopups = [];
    public $selectAll = false;

    protected $queryString = ['search', 'perPage'];

    public function toggleFilter()
    {
        $this->filter = !$this->filter;
    }

    public function applyFilters()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->filter = false;
        $this->resetPage();
    }

    public function goToPage($page)
    {
        $this->setPage($page);
    }

    public function toggleSelectAll($checked)
    {
        if ($checked) {
            $this->selectedPopups = Popup::pluck('id')->toArray();
        } else {
            $this->selectedPopups = [];
        }
    }

    public function toggleActive($id)
    {
        $popup = Popup::find($id);
        if ($popup) {
            $popup->is_active = !$popup->is_active;
            $popup->save();
            session()->flash('success', 'Popup status updated!');
        }
    }

    public function delete($id)
    {
        $popup = Popup::find($id);
        if ($popup) {
            if ($popup->cover_image) {
                Storage::disk('public')->delete($popup->cover_image);
            }
            if ($popup->thumbnail) {
                Storage::disk('public')->delete($popup->thumbnail);
            }
            $popup->delete();
            session()->flash('success', 'Popup deleted successfully!');
        }
    }

    public function deleteSelected()
    {
        $popups = Popup::whereIn('id', $this->selectedPopups)->get();

        foreach ($popups as $popup) {
            if ($popup->cover_image) {
                Storage::disk('public')->delete($popup->cover_image);
            }
            if ($popup->thumbnail) {
                Storage::disk('public')->delete($popup->thumbnail);
            }
        }

        Popup::whereIn('id', $this->selectedPopups)->delete();
        $this->selectedPopups = [];
        session()->flash('success', 'Selected popups deleted successfully!');
    }

    public function render()
    {
        $popups = Popup::where('title', 'like', '%' . $this->search . '%')
            ->orderBy('display_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.lists.popups-list', [
            'popups' => $popups
        ])->layout('components.admin.layout', [
            'tabTitle' => 'Popup Management',
            'pageTitle' => 'Popup Management',
            'breadcrumb' => 'Home ➔ Dashboard ➔ Popups'
        ]);
    }
}
