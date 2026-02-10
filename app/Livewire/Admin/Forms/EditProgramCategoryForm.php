<?php

namespace App\Livewire\Admin\Forms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\ProgramCategory;
use Illuminate\Validation\Rule;

class EditProgramCategoryForm extends Component
{
    use WithFileUploads;

    public ProgramCategory $category;

    public $name;
    public $slug;
    public $description;
    public $avatar;

    public function mount(ProgramCategory $category)
    {
        $this->category = $category;

        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->description = $category->description;
        // avatar is intentionally NOT set here
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                Rule::unique('program_categories', 'slug')
                    ->ignore($this->category->id),
            ],
            'description' => 'nullable|string',
            'avatar' => 'nullable|image|max:1024', // 1MB
        ];
    }

    /**
     * Auto-generate slug only if it matches old slug
     */
    public function updatedName($value)
    {
        if ($this->slug === $this->category->slug) {
            $this->slug = Str::slug($value);
        }
    }

    public function update()
    {
        $validated = $this->validate();

        /*
        |--------------------------------------------------------------------------
        | Prevent avatar from being nulled
        |--------------------------------------------------------------------------
        */
        unset($validated['avatar']);

        if ($this->avatar) {
            $validated['avatar'] = $this->avatar->store(
                'program-categories',
                'public'
            );
        }

        $this->category->update($validated);

        session()->flash('success', 'Program category updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.forms.edit-program-category-form');
    }
}
