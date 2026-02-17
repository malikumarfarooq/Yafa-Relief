<?php

namespace App\Livewire\Admin\Forms\Content;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Stories;
use Illuminate\Validation\Rule;

class EditStoryForm extends Component
{
    use WithFileUploads;

    public Stories $story;

    public $title;
    public $slug;
    public $description;
    public $thumbnail;
    public $cover_image;
    public $is_featured;
    public $is_active;
    public $short_description;

    public function mount(Stories $story)
    {
        $this->story = $story;

        $this->title = $story->title;
        $this->slug = $story->slug;
        $this->description = $story->description;
        $this->is_featured = $story->is_featured;
        $this->is_active = $story->is_active;
        $this->short_description = $story->short_description;
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                Rule::unique('stories', 'slug')
                    ->ignore($this->story->id),
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
        if ($this->slug === $this->story->slug) {
            $this->slug = Str::slug($value);
        }
    }

    public function update()
    {
        $validated = $this->validate();

        if ($this->thumbnail) {
            $validated['thumbnail'] = $this->thumbnail->store(
                'content/storys',
                'public'
            );
        } else {
            unset($validated['thumbnail']);
        }

        if ($this->cover_image) {
            $validated['cover_image'] = $this->cover_image->store(
                'content/storys',
                'public'
            );
        } else {
            unset($validated['cover_image']);
        }

        $this->story->update($validated);

        session()->flash('success', 'Story updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.forms.content.edit-story-form');
    }
}
