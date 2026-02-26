<?php

namespace App\Livewire\Website;

use App\Models\Popup;
use Livewire\Component;

class DynamicPopup extends Component
{
    public ?array $popupData = null;

    public function mount(): void
    {
        $popup = Popup::active()->first();

        if ($popup) {
            // Pass only plain data — no Eloquent model
            // This prevents Livewire from tracking/re-rendering the model
            $this->popupData = [
                'id'                => $popup->id,
                'title'             => $popup->title,
                'description'       => $popup->description,
                'short_description' => $popup->short_description,
                'cover_image_url'   => $popup->cover_image
                    ? asset('storage/' . $popup->cover_image)
                    : null,
                'button_text'       => $popup->button_text ?: 'Make an Impact',
                'redirect_url'      => $popup->redirect_url,
                'cooldown_hours'    => $popup->cooldown_hours ?? 6,
            ];
        }
    }

    public function render()
    {
        return view('livewire.website.dynamic-popup');
    }
}
