<?php

namespace App\Livewire\Admin\Forms\Content;

use App\Models\Posts;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePostForm extends Component
{
    use WithFileUploads;

    public $title;

    public $slug;

    public $description;

    public $thumbnail;

    public $cover_image;

    public $is_featured = false;

    public $is_active = true;

    public $short_description;

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:posts,slug',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:1024', // 1MB
            'cover_image' => 'nullable|image|max:1024', // 1MB
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'short_description' => 'nullable|string',
        ];
    }

    /**
     * Auto-generate slug when name changes
     */
    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->thumbnail) {
            $validated['thumbnail'] = $this->thumbnail->store(
                'content/posts',
                'public'
            );
        }

        if ($this->cover_image) {
            $validated['cover_image'] = $this->cover_image->store(
                'content/posts',
                'public'
            );
        }

        Posts::create($validated);

        $this->reset(['title', 'slug', 'description', 'thumbnail', 'cover_image', 'is_active', 'is_featured', 'short_description']);
        $this->dispatch('resetEditor');

        session()->flash('success', 'Post created successfully.');
    }

    public function render()
    {
        return view('livewire.admin.forms.content.create-post-form');
    }
}
