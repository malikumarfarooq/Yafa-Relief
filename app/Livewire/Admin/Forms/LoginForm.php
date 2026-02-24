<?php

namespace App\Livewire\Admin\Forms;

use App\Services\AuthService;
use Livewire\Component;

class LoginForm extends Component
{
    public $email = '';

    public $password = '';

    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    public function submit(AuthService $authService)
    {
        $this->validate();

        $authenticated = $authService->authenticate(
            $this->email,
            $this->password,
            $this->remember
        );

        if ($authenticated) {
            session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }

        $this->addError('email', 'Invalid credentials provided.');
    }

    public function render()
    {
        return view('livewire.admin.forms.login-form');
    }
}
