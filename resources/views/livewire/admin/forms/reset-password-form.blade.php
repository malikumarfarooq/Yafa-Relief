<form wire:submit.prevent="resetPassword">

    <a href="#" class="brand-name mt-3">
        <img src="/admin-assets/images/logo.png" alt="Brand Logo" class="logo-img">
        {{env('APP_CRM_TITLE')}}
    </a>

    <p class="auth-screen-label highlight-text mt-5">Reset Password</p>
    <div class="greeting-text mb-5">Complete the process to access</div>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="form-group">
        <label>New Password:</label>
        <div style="position: relative;">
            <input type="password" wire:model="password" class="form-control" style="padding-right: 40px;">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="form-group">
        <label>Confirm New Password:</label>
        <div style="position: relative;">
            <input type="password" wire:model="password_confirmation" class="form-control"
                style="padding-right: 40px;">
        </div>
    </div>

    <button type="submit" class="btn btn-primary w-100">
        Update Password
    </button>

    <p class="signup-link text-start mt-4">
        I know my password?
        <a href="{{ route('admin.login') }}">Login</a>
    </p>
</form>
