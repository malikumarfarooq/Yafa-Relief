<?php

namespace App\Livewire\Admin\Forms;

use Livewire\Component;
use App\Services\AuthService;

class ForgotPasswordForm extends Component
{
    public $email = '';

    protected $rules = [
        'email' => 'required|email|exists:users,email',
    ];

    public function submit(AuthService $authService)
    {
        $this->validate();

        $result = $authService->forgotPassword($this->email);

        if ($result !== true) {
            // If the service didn't return true, it returned an error status string
            $this->addError('email', __($result));
        }
    }

    public function render()
    {
        return view('livewire.admin.forms.forgot-password-form');
    }
}
