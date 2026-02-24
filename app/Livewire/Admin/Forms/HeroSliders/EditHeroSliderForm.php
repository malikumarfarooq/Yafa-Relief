<?php

namespace App\Livewire\Admin\Forms\HeroSliders;

use App\Models\HeroSlider;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditHeroSliderForm extends Component
{
    use WithFileUploads;

    public HeroSlider $heroSlider;

    public $title = '';

    public $subtitle = '';

    public $description = '';

    public $button_text = '';

    public $button_url = '';

    public $media_type = 'image';

    public $media = null;

    public $mobile_media = null;

    public $order = 0;

    public $status = 'active';

    public function mount(HeroSlider $heroSlider): void
    {
        $this->heroSlider = $heroSlider;
        $this->title = $heroSlider->title;
        $this->subtitle = $heroSlider->subtitle;
        $this->description = $heroSlider->description;
        $this->button_text = $heroSlider->button_text;
        $this->button_url = $heroSlider->button_url;
        $this->media_type = $heroSlider->media_type;
        $this->order = $heroSlider->order;
        $this->status = $heroSlider->status;
    }

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'media_type' => 'required|in:image,video',
            'media' => 'nullable|file|max:51200',
            'mobile_media' => 'nullable|file|max:51200',
            'order' => 'integer|min:0',
            'status' => 'required|in:active,inactive',
        ];
    }

    public function update(): void
    {
        $this->validate();

        $mediaPath = $this->heroSlider->media_path;
        $mobileMediaPath = $this->heroSlider->mobile_media_path;

        // Replace main media if new file uploaded
        if ($this->media) {
            Storage::disk('public')->delete($mediaPath);
            $mediaPath = $this->media->store('hero-sliders', 'public');
        }

        // Replace mobile media if new file uploaded
        if ($this->mobile_media) {
            if ($mobileMediaPath) {
                Storage::disk('public')->delete($mobileMediaPath);
            }
            $mobileMediaPath = $this->mobile_media->store('hero-sliders/mobile', 'public');
        }

        $this->heroSlider->update([
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'description' => $this->description,
            'button_text' => $this->button_text,
            'button_url' => $this->button_url,
            'media_type' => $this->media_type,
            'media_path' => $mediaPath,
            'mobile_media_path' => $mobileMediaPath,
            'order' => $this->order,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Slide updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.forms.hero-sliders.edit-hero-slider-form');
    }
}
