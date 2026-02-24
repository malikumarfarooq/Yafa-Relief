<?php

namespace App\Livewire\Admin\Lists\HeroSliders;

use App\Models\HeroSlider;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class HeroSliderList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $perPage = 10;

    public $filter = false;

    public $selectedSliders = [];

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
        $this->filter = ! $this->filter;
    }

    public function resetFilters(): void
    {
        $this->search = '';
        $this->perPage = 10;
        $this->selectedSliders = [];
        $this->resetPage();
    }

    public function applyFilters(): void
    {
        $this->resetPage();
    }

    public function toggleSelectAll($checked): void
    {
        if ($checked) {
            $this->selectedSliders = HeroSlider::query()
                ->when(
                    $this->search,
                    fn ($q) => $q->where('title', 'like', "%{$this->search}%")
                )
                ->limit($this->perPage)
                ->pluck('id')
                ->toArray();
        } else {
            $this->selectedSliders = [];
        }
    }

    public function toggleStatus(int $id): void
    {
        $slider = HeroSlider::findOrFail($id);
        $slider->update([
            'status' => $slider->status === 'active' ? 'inactive' : 'active',
        ]);
    }

    public function updateOrder(array $order): void
    {
        foreach ($order as $item) {
            HeroSlider::where('id', $item['value'])
                ->update(['order' => $item['order']]);
        }
    }

    public function delete(int $id): void
    {
        $slider = HeroSlider::findOrFail($id);

        if ($slider->media_path) {
            Storage::disk('public')->delete($slider->media_path);
        }
        if ($slider->mobile_media_path) {
            Storage::disk('public')->delete($slider->mobile_media_path);
        }

        $slider->delete();
        session()->flash('success', 'Slide deleted successfully.');
    }

    public function render()
    {
        $sliders = HeroSlider::query()
            ->when(
                $this->search,
                fn ($q) => $q->where('title', 'like', "%{$this->search}%")
            )
            ->orderBy('order', 'asc')
            ->paginate($this->perPage);

        return view('livewire.admin.lists.hero-sliders.hero-slider-list', [
            'sliders' => $sliders,
        ]);
    }
}
