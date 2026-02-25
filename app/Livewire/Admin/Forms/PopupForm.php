<?php

namespace App\Livewire\Admin\Forms;

use App\Models\Popup;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PopupForm extends Component
{
    use WithFileUploads;

    public $popupId;
    public $title;
    public $description;
    public $short_description;
    public $button_text = 'Make an Impact';
    public $cooldown_hours = 6;
    public $display_order = 0;
    public $is_active = false;
    public $starts_at;
    public $ends_at;
    public $redirect_url;
    public $cover_image;
    public $thumbnail;
    public $coverImage;
    public $thumbnailImage;
    public $existingCoverImage;
    public $existingThumbnail;

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'button_text' => 'required|string|max:50',
            'redirect_url' => 'nullable|string|max:255',
            'cooldown_hours' => 'integer|min:1',
            'display_order' => 'integer|min:0',
            'is_active' => 'boolean',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
            'coverImage' => 'nullable|image|max:1024',
            'thumbnailImage' => 'nullable|image|max:1024',
        ];
    }

    public function mount($id = null)
    {
        if ($id) {
            $popup = Popup::find($id);
            if ($popup) {
                $this->popupId = $popup->id;
                $this->title = $popup->title;
                $this->description = $popup->description;
                $this->short_description = $popup->short_description;
                $this->button_text = $popup->button_text;
                $this->redirect_url = $popup->redirect_url;
                $this->existingCoverImage = $popup->cover_image;
                $this->existingThumbnail = $popup->thumbnail;
                $this->is_active = $popup->is_active;
                $this->cooldown_hours = $popup->cooldown_hours;
                $this->display_order = $popup->display_order;
                $this->starts_at = $popup->starts_at ? $popup->starts_at->format('Y-m-d\TH:i') : null;
                $this->ends_at = $popup->ends_at ? $popup->ends_at->format('Y-m-d\TH:i') : null;
            }
        }
    }

    public function updatedTitle($value)
    {
        // Auto-generate slug if needed - keeping for compatibility
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'button_text' => $this->button_text,
            'redirect_url' => $this->redirect_url,
            'is_active' => $this->is_active ?? false,
            'cooldown_hours' => $this->cooldown_hours,
            'display_order' => $this->display_order,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
        ];

        // Handle cover image upload
        if ($this->coverImage) {
            if ($this->popupId && $this->existingCoverImage) {
                Storage::disk('public')->delete($this->existingCoverImage);
            }
            $path = $this->coverImage->store('popups/cover', 'public');
            $data['cover_image'] = $path;
        } elseif ($this->popupId) {
            $data['cover_image'] = $this->existingCoverImage;
        }

        // Handle thumbnail upload
        if ($this->thumbnailImage) {
            if ($this->popupId && $this->existingThumbnail) {
                Storage::disk('public')->delete($this->existingThumbnail);
            }
            $path = $this->thumbnailImage->store('popups/thumbnails', 'public');
            $data['thumbnail'] = $path;
        } elseif ($this->popupId) {
            $data['thumbnail'] = $this->existingThumbnail;
        }

        if ($this->popupId) {
            $popup = Popup::find($this->popupId);
            $popup->update($data);
            $message = 'Popup updated successfully!';
        } else {
            Popup::create($data);
            $message = 'Popup created successfully!';
        }

        session()->flash('success', $message);
        return redirect()->route('admin.popups.index');
    }

    public function render()
    {
        return view('livewire.admin.forms.popup-form', [
            'popup' => $this->popupId ? Popup::find($this->popupId) : null
        ])->layout('components.admin.layout', [
            'tabTitle' => $this->popupId ? 'Edit Popup' : 'Create Popup',
            'pageTitle' => $this->popupId ? 'Edit Popup' : 'Create Popup',
            'breadcrumb' => 'Home ➔ Dashboard ➔ Popups ➔ ' . ($this->popupId ? 'Edit' : 'Create')
        ]);
    }
}
