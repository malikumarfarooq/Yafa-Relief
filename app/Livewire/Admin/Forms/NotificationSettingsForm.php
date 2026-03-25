<?php

namespace App\Livewire\Admin\Forms;

use App\Models\SystemSetting;
use Livewire\Component;

class NotificationSettingsForm extends Component
{
    public $settings = [];

    protected $rules = [
        'settings.*' => 'boolean',
    ];

    public function mount()
    {
        $this->settings = [
            'donation_confirmation' => SystemSetting::getValue('notification_donation_confirmation', true),
            'admin_new_donation' => SystemSetting::getValue('notification_admin_new_donation', true),
            'newsletter_subscription' => SystemSetting::getValue('notification_newsletter_subscription', true),
            'contact_message' => SystemSetting::getValue('notification_contact_message', true),
            'program_updates' => SystemSetting::getValue('notification_program_updates', false),
        ];
    }

    public function save()
    {
        $this->validate();

        foreach ($this->settings as $key => $value) {
            SystemSetting::setValue('notification_' . $key, $value);
        }

        session()->flash('success', 'Notification settings updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.forms.notification-settings-form');
    }
}