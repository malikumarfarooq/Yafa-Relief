<?php

namespace App\Livewire\Admin\Forms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Program;
use App\Models\ProgramCategory;

class CreateProgramForm extends Component
{
    use WithFileUploads;

    // Text
    public $title;
    public $slug;
    public $short_description;
    public $description;
    public $legacy_message;
    public $promises; // string input

    // Media
    public $thumbnail;
    public $cover_image;

    // Financial
    public $goal_amount;
    public $min_amount;
    public $amount_options; // comma-separated string

    // Flags
    public $is_featured = false;
    public $is_active = true;
    public $is_recurring_allowed = false;
    public $is_urgent = false; // safe even if column not added yet

    // Dates
    public $start_date;
    public $end_date;

    // Categories
    public $categories = [];
    public $selected_categories = [];

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:campaigns,slug',
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
        ];
    }

    public function mount()
    {
        $this->categories = ProgramCategory::select('id', 'name')->get();
    }

    public function updatedTitle($value)
    {
        if (!$this->slug) {
            $this->slug = Str::slug($value);
        }
    }

    public function save()
    {
        $validated = $this->validate();

        // Convert promises: "a || b || c" → ["a","b","c"]
        $validated['promises'] = $this->promises
            ? array_values(array_filter(array_map('trim', explode('||', $this->promises))))
            : null;

        // Convert amount options: "100,200" → [100,200]
        $validated['amount_options'] = $this->amount_options
            ? array_map('floatval', explode(',', $this->amount_options))
            : null;

        // Uploads
        if ($this->thumbnail) {
            $validated['thumbnail'] = $this->thumbnail->store('campaigns/thumbnails', 'public');
        }

        if ($this->cover_image) {
            $validated['cover_image'] = $this->cover_image->store('campaigns/covers', 'public');
        }

        // Extra defaults
        $validated['associated_category_ids'] = $this->selected_categories;
        $validated['current_amount'] = 0;
        $validated['donors_count'] = 0;
        $validated['is_featured'] = $this->is_featured;
        $validated['is_active'] = $this->is_active;
        $validated['is_recurring_allowed'] = $this->is_recurring_allowed;

        Program::create($validated);

        $this->reset();
        session()->flash('success', 'Program created successfully.');
    }

    public function render()
    {
        return view('livewire.admin.forms.create-program-form');
    }
}
