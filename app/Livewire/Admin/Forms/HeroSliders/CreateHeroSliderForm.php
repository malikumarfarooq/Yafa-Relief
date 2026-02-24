<?php

namespace App\Livewire\Admin\Forms\HeroSliders;

use App\Models\HeroSlider;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateHeroSliderForm extends Component
{
    use WithFileUploads;

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

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'media_type' => 'required|in:image,video',
            'media' => 'required|file|max:51200',
            'mobile_media' => 'nullable|file|max:51200',
            'order' => 'integer|min:0',
            'status' => 'required|in:active,inactive',
        ];
    }

    public function save(): void
    {
        $this->validate();

        $mediaPath = $this->media->store('hero-sliders', 'public');

        $mobileMediaPath = null;
        if ($this->mobile_media) {
            $mobileMediaPath = $this->mobile_media->store('hero-sliders/mobile', 'public');
        }

        HeroSlider::create([
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

        $this->reset();
        session()->flash('success', 'Slide created successfully.');
    }

    public function render()
    {
        return view('livewire.admin.forms.hero-sliders.create-hero-slider-form');
    }
}
