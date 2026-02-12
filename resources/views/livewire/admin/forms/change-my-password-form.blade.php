<form wire:submit.prevent="submit">
    <div class="row mt-md-5 mt-3">

        <div class="col-md-4 mb-3">
            <label class="form-label fw-bold">Current Password</label>
            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                wire:model="current_password" placeholder="Enter current password">
            @error('current_password') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-12 mb-3 text-muted">Fill out the new passwords</div>

        <div class="col-md-4 mb-3">
            <label class="form-label fw-bold">New Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model="password"
                placeholder="Enter new password">
            @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label fw-bold">Confirm New Password</label>
            <input type="password" class="form-control" wire:model="password_confirmation"
                placeholder="Confirm new password">
        </div>

        <div class="col-md-12 mt-3">
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Update Password</span>
                <span wire:loading>Updating...</span>
            </button>
        </div>
    </div>
    @if (session()->has('success'))
    <div class="alert alert-success mt-3 d-flex justify-content-between align-items-center gap-3"
        style="position: fixed; bottom: 0px; right: 40px; z-index: 9999;">
        <span class="pe-5">{{ session('success') }}</span> <span style="font-size: 48px"
            class="position-absolute top-50 start-100 translate-middle">😎</span>
    </div>
    @endif
</form>