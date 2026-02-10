<?php

namespace App\Livewire\Admin\Forms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\ProgramAttribute;
use Illuminate\Validation\Rule;

class EditProgramAttributeForm extends Component
{
    use WithFileUploads;

    public ProgramAttribute $attribute;

    public $name;
    public $slug;
    public $description;
    public $avatar;

    public function mount(ProgramAttribute $attribute)
    {
        $this->attribute = $attribute;

        $this->name = $attribute->name;
        $this->slug = $attribute->slug;
        $this->description = $attribute->description;
        // avatar is intentionally NOT set here
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                Rule::unique('program_attributes', 'slug')
                    ->ignore($this->attribute->id),
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
        if ($this->slug === $this->attribute->slug) {
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
                'program-attributes',
                'public'
            );
        }

        $this->attribute->update($validated);

        session()->flash('success', 'Program attribute updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.forms.edit-program-attribute-form');
    }
}
