<?php

namespace App\Livewire\Admin\Forms\Content;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditNewsForm extends Component
{
    use WithFileUploads;

    public News $news;

    public $title;

    public $slug;

    public $description;

    public $thumbnail;

    public $cover_image;

    public $is_featured;

    public $is_active;

    public $short_description;

    public function mount(News $news)
    {
        $this->news = $news;

        $this->title = $news->title;
        $this->slug = $news->slug;
        $this->description = $news->description;
        $this->is_featured = $news->is_featured;
        $this->is_active = $news->is_active;
        $this->short_description = $news->short_description;
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                Rule::unique('news', 'slug')
                    ->ignore($this->news->id),
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
        if ($this->slug === $this->news->slug) {
            $this->slug = Str::slug($value);
        }
    }

    public function update()
    {
        $validated = $this->validate();

        if ($this->thumbnail) {
            $validated['thumbnail'] = $this->thumbnail->store(
                'content/news',
                'public'
            );
        } else {
            unset($validated['thumbnail']);
        }

        if ($this->cover_image) {
            $validated['cover_image'] = $this->cover_image->store(
                'content/news',
                'public'
            );
        } else {
            unset($validated['cover_image']);
        }

        $this->news->update($validated);

        session()->flash('success', 'News updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.forms.content.edit-news-form');
    }
}
