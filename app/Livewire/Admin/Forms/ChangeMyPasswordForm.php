<?php

namespace App\Livewire\Admin\Forms;

use App\Services\AuthService;
// Ensure this matches your Service namespace
use Livewire\Component;

class ChangeMyPasswordForm extends Component
{
    public $current_password;

    public $password;

    public $password_confirmation;

    protected $rules = [
        'current_password' => 'required',
        'password' => 'required|string|min:8|confirmed', // 'confirmed' looks for password_confirmation
    ];

    public function submit(AuthService $authService)
    {
        $this->validate();

        $authService->updateMyPassword([
            'current_password' => $this->current_password,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ]);

        session()->flash('success', 'Password updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.forms.change-my-password-form');
    }
}
