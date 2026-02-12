<form wire:submit.prevent="submit">

    <a href="" class="brand-name mt-3">
        <img src="/admin-assets/images/logo.png" alt="Brand Logo" class="logo-img">
        {{env('APP_CRM_TITLE')}}
    </a>

    <p class="auth-screen-label highlight-text mt-5">Login</p>
    <div class="greeting-text mb-5">Welcome Back!</div>

    {{-- Email --}}
    <div class="form-group mb-3">
        <label>Email</label>
        <input type="email"
               wire:model.defer="email"
               class="form-control @error('email') is-invalid @enderror">

        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Password --}}
    <div class="form-group">
        <label class="d-flex justify-content-between align-items-center">
            Password:
            <a href="/admin/forgot-password" class="label-link">
                Forgot your password?
            </a>
        </label>

        <input type="password"
               wire:model.defer="password"
               class="form-control @error('password') is-invalid @enderror">

        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Remember --}}
    <div class="form-check my-3">
        <input type="checkbox"
               wire:model="remember"
               class="form-check-input">

        <label class="form-check-label secondary-text">
            Remember me
        </label>
    </div>

    <button type="submit" class="btn btn-primary w-100">
        Log In
    </button>

</form>
