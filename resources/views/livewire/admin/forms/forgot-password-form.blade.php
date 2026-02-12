<form wire:submit.prevent="submit">
    <a href="" class="brand-name mt-3">
        <img src="/admin-assets/images/logo.png" alt="Brand Logo" class="logo-img">
        {{env('APP_CRM_TITLE')}}
    </a>

    <p class="auth-screen-label highlight-text mt-5">Forgot Password</p>
    <div class="greeting-text mb-5">Reset your password</div>

    {{-- Email --}}
    <div class="form-group mb-3">
        <label>Email</label>
        <input type="email" wire:model.defer="email" class="form-control @error('email') is-invalid @enderror"
            placeholder="Enter your email">

        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary w-100">
        Send Reset Link
    </button>
        @if (session('status'))
    <div class="alert alert-success my-3">
        {{ session('status') }}
    </div>
    @endif

    <p class="signup-link text-start mt-4">Remember your password? <a href="{{ route('admin.login') }}">Login</a></p>
</form>
