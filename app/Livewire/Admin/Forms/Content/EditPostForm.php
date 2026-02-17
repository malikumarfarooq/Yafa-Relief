<?php

namespace App\Livewire\Admin\Forms\Content;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Posts;
use Illuminate\Validation\Rule;

class EditPostForm extends Component
{
    use WithFileUploads;

    public Posts $post;

    public $title;
    public $slug;
    public $description;
    public $thumbnail;
    public $cover_image;
    public $is_featured;
    public $is_active;
    public $short_description;

    public function mount(Posts $post)
    {
        $this->post = $post;

        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->description = $post->description;
        $this->is_featured = $post->is_featured;
        $this->is_active = $post->is_active;
        $this->short_description = $post->short_description;
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                Rule::unique('posts', 'slug')
                    ->ignore($this->post->id),
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
        if ($this->slug === $this->post->slug) {
            $this->slug = Str::slug($value);
        }
    }

    public function update()
    {
        $validated = $this->validate();

        if ($this->thumbnail) {
            $validated['thumbnail'] = $this->thumbnail->store(
                'content/posts',
                'public'
            );
        } else {
            unset($validated['thumbnail']);
        }

        if ($this->cover_image) {
            $validated['cover_image'] = $this->cover_image->store(
                'content/posts',
                'public'
            );
        } else {
            unset($validated['cover_image']);
        }

        $this->post->update($validated);

        session()->flash('success', 'Post updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.forms.content.edit-post-form');
    }
}
