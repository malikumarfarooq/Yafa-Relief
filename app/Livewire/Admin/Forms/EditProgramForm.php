<?php

namespace App\Livewire\Admin\Forms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Program;
use App\Models\ProgramCategory;
use Illuminate\Validation\Rule;
use App\Models\ProgramMedia;
use App\Models\ProgramAttribute;

class EditProgramForm extends Component
{
    use WithFileUploads;

    public Program $program;
    public $gallery = [];
    public $existingMedia = [];
    // Text
    public $title;
    public $slug;
    public $short_description;
    public $description;
    public $legacy_message;
    public $promises;

    // Media
    public $thumbnail;
    public $cover_image;

    // Financial
    public $goal_amount;
    public $min_amount;
    public $amount_options;

    // Flags
    public $is_featured;
    public $is_active;
    public $is_recurring_allowed;
    public $is_urgent;

    // Dates
    public $start_date;
    public $end_date;

    // Categories
    public $categories = [];
    public $selected_categories = [];

    public $attributes = [];
    public $selected_attributes = [];

    public function mount(Program $program)
    {
        $this->program = $program;
        $this->existingMedia = $program->media()->get();
        // Prefill fields
        $this->title = $program->title;
        $this->slug = $program->slug;
        $this->short_description = $program->short_description;
        $this->description = $program->description;
        $this->legacy_message = $program->legacy_message;

        $this->promises = $program->promises
            ? implode(' || ', $program->promises)
            : null;

        $this->goal_amount = $program->goal_amount;
        $this->min_amount = $program->min_amount;

        $this->amount_options = $program->amount_options
            ? implode(',', $program->amount_options)
            : null;

        $this->is_featured = $program->is_featured;
        $this->is_active = $program->is_active;
        $this->is_recurring_allowed = $program->is_recurring_allowed;
        $this->is_urgent = $program->is_urgent ?? false;

        $this->start_date = $program->start_date?->format('Y-m-d\TH:i');
        $this->end_date = $program->end_date?->format('Y-m-d\TH:i');

        $this->selected_categories = $program->associated_category_ids ?? [];

        $this->categories = ProgramCategory::select('id', 'name')->get();

            $this->selected_attributes = $program->associated_attribute_ids ?? [];
            $this->attributes = ProgramAttribute::select('id', 'name')->get();
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                Rule::unique('programs', 'slug')->ignore($this->program->id),
            ],
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'legacy_message' => 'nullable|string',
            'promises' => 'nullable|string',

            'thumbnail' => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:2048',

            'goal_amount' => 'required|numeric|min:1',
            'min_amount' => 'nullable|numeric|min:1',
            'amount_options' => 'nullable|string',
            'is_urgent' => 'boolean',

            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',

            'selected_categories' => 'nullable|array',
            'selected_attributes' => 'nullable|array',
            'gallery.*' => 'image|max:2048',

        ];
    }

    public function update()
    {
        $validated = $this->validate();

        // Transform JSON fields
        $validated['promises'] = $this->promises
            ? array_values(array_filter(array_map('trim', explode('||', $this->promises))))
            : null;

        $validated['amount_options'] = $this->amount_options
            ? array_map('floatval', explode(',', $this->amount_options))
            : null;
        unset($validated['thumbnail'], $validated['cover_image']);
        // Uploads (replace only if changed)
        if ($this->thumbnail) {
            $validated['thumbnail'] = $this->thumbnail->store('programs/thumbnails', 'public');
        }

        if ($this->cover_image) {
            $validated['cover_image'] = $this->cover_image->store('programs/covers', 'public');
        }

        // Flags & categories
        $validated['associated_category_ids'] = $this->selected_categories;
        $validated['associated_attribute_ids'] = $this->selected_attributes;
        $validated['is_featured'] = $this->is_featured;
        $validated['is_active'] = $this->is_active;
        $validated['is_recurring_allowed'] = $this->is_recurring_allowed;
        $validated['is_urgent'] = $this->is_urgent;
        if (!empty($this->gallery)) {
            foreach ($this->gallery as $index => $image) {
                $path = $image->store('programs/gallery', 'public');

                ProgramMedia::create([
                    'program_id' => $this->program->id,
                    'type'       => 'image',
                    'url'        => $path,
                    'order'      => $index,
                ]);
            }
        }
        $this->program->update($validated);

        session()->flash('success', 'Program updated successfully.');
    }
    public function removeMedia($mediaId)
    {
        $media = ProgramMedia::findOrFail($mediaId);

        if (\Storage::disk('public')->exists($media->url)) {
            \Storage::disk('public')->delete($media->url);
        }

        $media->delete();

        $this->existingMedia = $this->program->media()->get();
    }


    public function render()
    {
        return view('livewire.admin.forms.edit-program-form');
    }
}
