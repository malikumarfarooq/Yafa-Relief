<?php

namespace App\Livewire\Admin\Forms;

use App\Models\ProgramCategory;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProgramCategoryForm extends Component
{
    use WithFileUploads;

    public $name;

    public $slug;

    public $description;

    public $avatar;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:program_categories,slug',
            'description' => 'nullable|string',
            'avatar' => 'nullable|image|max:1024', // 1MB
        ];
    }

    /**
     * Auto-generate slug when name changes
     */
    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->avatar) {
            $validated['avatar'] = $this->avatar->store(
                'program-categories',
                'public'
            );
        }

        ProgramCategory::create($validated);

        $this->reset(['name', 'slug', 'description', 'avatar']);

        session()->flash('success', 'Program category created successfully.');
    }

    public function render()
    {
        return view('livewire.admin.forms.create-program-category-form');
    }
}
