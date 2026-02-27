<?php

namespace App\Livewire\Admin\Forms;

use App\Models\Popup;
use App\Models\Program;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PopupForm extends Component
{
    use WithFileUploads;

    // ── Route param ───────────────────────────────────────────
    public $popupId;

    // ── Form fields ───────────────────────────────────────────
    public $title             = '';
    public $description       = '';
    public $short_description = '';
    public $button_text       = 'Make an Impact';
    public $redirect_url      = '';
    public $cooldown_hours    = 6;
    public $display_order     = 0;
    public $is_active         = false;
    public $starts_at         = '';
    public $ends_at           = '';

    // ── Resource linking ──────────────────────────────────────
    public $resource_type     = ''; // 'program' (extend later for 'resource')
    public $resource_id       = '';
    public $resourceList      = [];

    // ── Images ────────────────────────────────────────────────
    public $newCoverImage;       // new upload
    public $newThumbnail;        // new upload
    public $existingCoverImage;  // path stored in DB
    public $existingThumbnail;   // path stored in DB

    // ── Validation ────────────────────────────────────────────
    protected function rules(): array
    {
        return [
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'button_text'      => 'required|string|max:100',
            'redirect_url'     => 'nullable|string|max:255',
            'cooldown_hours'   => 'required|integer|min:1',
            'display_order'    => 'required|integer|min:0',
            'is_active'        => 'boolean',
            'starts_at'        => 'nullable|date',
            'ends_at'          => 'nullable|date',
            'newCoverImage'    => 'nullable|image|max:2048',
            'newThumbnail'     => 'nullable|image|max:2048',
        ];
    }

    // ── Mount ─────────────────────────────────────────────────
    public function mount($id = null): void
    {
        if ($id) {
            $popup = Popup::findOrFail($id);
            $this->popupId           = $popup->id;
            $this->title             = $popup->title;
            $this->description       = $popup->description;
            $this->short_description = $popup->short_description;
            $this->button_text       = $popup->button_text;
            $this->redirect_url      = $popup->redirect_url;
            $this->cooldown_hours    = $popup->cooldown_hours;
            $this->display_order     = $popup->display_order;
            $this->is_active         = $popup->is_active;
            $this->starts_at         = $popup->starts_at?->format('Y-m-d\TH:i');
            $this->ends_at           = $popup->ends_at?->format('Y-m-d\TH:i');
            $this->existingCoverImage = $popup->cover_image;
            $this->existingThumbnail = $popup->thumbnail;
            $this->resource_type     = $popup->resource_type ?? '';
            $this->resource_id       = $popup->resource_id ?? '';

            // Load resource list if type is set
            if ($this->resource_type) {
                $this->loadResourceList();
            }
        }
    }

    // ── When resource_type changes → load list ────────────────
    public function updatedResourceType($value): void
    {
        $this->resource_id  = '';
        $this->resourceList = [];

        if ($value) {
            $this->loadResourceList();
        }
    }

    public function updatedResourceId($value): void
    {
        if (!$value) return;

        $model = $this->getResourceModel($value);
        if (!$model) return;

        $this->title              = $model->title;
        $this->short_description  = $model->short_description ?? '';
        $this->description        = $model->description ?? '';
        $this->existingCoverImage = $model->cover_image ?? '';
        $this->newCoverImage      = null;

        if ($this->resource_type === 'program') {
            $this->redirect_url = '/programs/' . $model->slug;
        }
    }

    // ── Save ──────────────────────────────────────────────────
    public function save(): void
    {
        $this->validate();

        $data = [
            'title'             => $this->title,
            'description'       => $this->description,
            'short_description' => $this->short_description,
            'button_text'       => $this->button_text,
            'redirect_url'      => $this->redirect_url,
            'is_active'         => $this->is_active ?? false,
            'cooldown_hours'    => $this->cooldown_hours,
            'display_order'     => $this->display_order,
            'starts_at'         => $this->starts_at ?: null,
            'ends_at'           => $this->ends_at ?: null,
            'resource_type'     => $this->resource_type ?: null,
            'resource_id'       => $this->resource_id ?: null,
        ];

        // Handle cover image
        if ($this->newCoverImage) {
            if ($this->existingCoverImage) {
                Storage::disk('public')->delete($this->existingCoverImage);
            }
            $data['cover_image'] = $this->newCoverImage->store('popups/covers', 'public');
        } else {
            $data['cover_image'] = $this->existingCoverImage;
        }

        // Handle thumbnail
        if ($this->newThumbnail) {
            if ($this->existingThumbnail) {
                Storage::disk('public')->delete($this->existingThumbnail);
            }
            $data['thumbnail'] = $this->newThumbnail->store('popups/thumbnails', 'public');
        } else {
            $data['thumbnail'] = $this->existingThumbnail;
        }

        if ($this->popupId) {
            Popup::findOrFail($this->popupId)->update($data);
            session()->flash('success', 'Popup updated successfully!');
        } else {
            Popup::create($data);
            session()->flash('success', 'Popup created successfully!');
        }

        redirect()->route('admin.popups.index');
    }

    // ── Helpers ───────────────────────────────────────────────
    private function loadResourceList(): void
    {
        if ($this->resource_type === 'program') {
            $this->resourceList = Program::select('id', 'title', 'slug', 'cover_image', 'short_description', 'description')
                ->where('is_active', true)
                ->orderBy('title')
                ->get()
                ->toArray();
        }
        // Add more types here later e.g. Resource model
    }

    private function getResourceModel($id)
    {
        if ($this->resource_type === 'program') {
            return Program::find($id);
        }
        return null;
    }

    public function render()
    {
        return view('livewire.admin.forms.popup-form')
            ->layout('components.admin.layout', [
                'tabTitle'   => $this->popupId ? 'Edit Popup' : 'Create Popup',
                'pageTitle'  => $this->popupId ? 'Edit Popup' : 'Create Popup',
                'breadcrumb' => 'Home ➔ Dashboard ➔ Popups ➔ ' . ($this->popupId ? 'Edit' : 'Create'),
            ]);
    }
}
