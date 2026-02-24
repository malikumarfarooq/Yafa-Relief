<?php

namespace App\Livewire\Admin\Forms;

use App\Services\AuthService;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ResetPasswordForm extends Component
{
    public $token;

    public $email;

    public $password;

    public $password_confirmation;

    public function mount($token)
    {
        $this->token = $token;
        $this->email = request()->query('email');
    }

    protected function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function resetPassword(AuthService $authService)
    {
        $validated = $this->validate();

        $status = $authService->resetUserPassword([
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'token' => $this->token,
        ]);

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('admin.login')
                ->with('success', 'Password reset successfully.');
        }

        $this->addError('email', __($status));
    }

    public function render()
    {
        return view('livewire.admin.forms.reset-password-form');
    }
}
