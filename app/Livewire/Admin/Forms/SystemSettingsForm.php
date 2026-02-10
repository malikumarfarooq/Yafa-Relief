<?php

namespace App\Livewire\Admin\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\SettingsService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SystemSettingsForm extends Component
{
    use WithFileUploads;

    public $state = [];
    public $logo, $favicon, $system_icon;

    // Define rules so Livewire knows how to handle the data
    protected $rules = [
        'state.application_title' => 'required|string',
        'logo' => 'nullable|image|max:1024',
        'favicon' => 'nullable|mimes:ico,png|max:512',
        'system_icon' => 'nullable|image|max:1024',
    ];

    public function mount(SettingsService $settings)
    {
        $this->state = $settings->getAllSettings();
    }

    public function save(SettingsService $settings)
    {
        $this->validate();

        // Handle Image Uploads
        if ($this->logo) {
            $this->state['logo_path'] = $this->logo->store('settings', 'public');
        }
        if ($this->favicon) {
            $this->state['favicon_path'] = $this->favicon->store('settings', 'public');
        }
        if ($this->system_icon) {
            $this->state['system_icon_path'] = $this->system_icon->store('settings', 'public');
        }

        // Persist to Database
        $settings->updateSettings($this->state);

        // Reset file inputs so the new paths show from the $state array
        $this->reset(['logo', 'favicon', 'system_icon']);

        session()->flash('success', 'System settings updated successfully.');
    }
    public function removeLogo(SettingsService $settings)
    {
        if (!empty($this->state['logo_path'])) {
            Storage::disk('public')->delete($this->state['logo_path']);
            $settings->updateSettings(['logo_path' => null]);
        }

        $this->logo = null;
        $this->state['logo_path'] = null;
    }

    public function removeFavicon(SettingsService $settings)
    {
        if (!empty($this->state['favicon_path'])) {
            Storage::disk('public')->delete($this->state['favicon_path']);
            $settings->updateSettings(['favicon_path' => null]);
        }

        $this->favicon = null;
        $this->state['favicon_path'] = null;
    }

    public function removeSystemIcon(SettingsService $settings)
    {
        if (!empty($this->state['system_icon_path'])) {
            Storage::disk('public')->delete($this->state['system_icon_path']);
            $settings->updateSettings(['system_icon_path' => null]);
        }

        $this->system_icon = null;
        $this->state['system_icon_path'] = null;
    }
    public function render(): View|Closure|string
    {
        return view('livewire.admin.forms.system-settings-form');
    }
}
