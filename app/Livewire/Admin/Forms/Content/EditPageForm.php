<?php

namespace App\Livewire\Admin\Forms\Content;

use App\Models\Pages;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditPageForm extends Component
{
    use WithFileUploads;

    public Pages $page;

    public $title;

    public $slug;

    public $description;

    public $thumbnail;

    public $cover_image;

    public $is_featured;

    public $is_active;

    public $short_description;

    public function mount(Pages $page)
    {
        $this->page = $page;

        $this->title = $page->title;
        $this->slug = $page->slug;
        $this->description = $page->description;
        $this->is_featured = $page->is_featured;
        $this->is_active = $page->is_active;
        $this->short_description = $page->short_description;
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                Rule::unique('pages', 'slug')
                    ->ignore($this->page->id),
            ],
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:1024',
            'cover_image' => 'nullable|image|max:1024',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'short_description' => 'nullable|string',
        ];
    }

    public function updatedTitle($value)
    {
        if ($this->slug === $this->page->slug) {
            $this->slug = Str::slug($value);
        }
    }

    public function update()
    {
        $validated = $this->validate();

        if ($this->thumbnail) {
            $validated['thumbnail'] = $this->thumbnail->store(
                'content/pages',
                'public'
            );
        } else {
            unset($validated['thumbnail']);
        }

        if ($this->cover_image) {
            $validated['cover_image'] = $this->cover_image->store(
                'content/pages',
                'public'
            );
        } else {
            unset($validated['cover_image']);
        }

        $this->page->update($validated);

        session()->flash('success', 'Page updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.forms.content.edit-page-form');
    }
}
