<form wire:submit.prevent="saveProfile">
    <div class="row mt-md-5 mt-3">
        <div class="col-md-2 text-md-end text-center">
            @if ($avatar)
            <img src="{{ $avatar->temporaryUrl() }}" class="w-100 rounded mb-3"
                style="max-height:280px !important; object-fit: cover;">
            @else
            <img src="{{ $currentAvatar ? asset('storage/'.$currentAvatar) : $placeholderImg }}"
                class="w-100 rounded mb-3" style="max-height:280px !important; object-fit: cover;">
            @endif

            <input type="file" class="form-control" wire:model="avatar">
            @error('avatar') <span class="text-danger small">{{ $message }}</span> @enderror
            <small class="text-muted d-block mt-1">Max 2MB (JPG, PNG)</small>
        </div>

        <div class="col-md-10">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label fw-bold">First Name</label>
                    <input type="text" class="form-control" wire:model="f_name">
                    @error('f_name') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label fw-bold">Last Name</label>
                    <input type="text" class="form-control" wire:model="l_name">
                    @error('l_name') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control bg-light" wire:model="email" readonly>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label fw-bold">Phone Number</label>
                    <input type="text" class="form-control" wire:model="phone">
                    @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3 col-12">
                    <label class="form-label fw-bold">Bio</label>
                    <textarea class="form-control" wire:model="bio" rows="3"></textarea>
                    @error('bio') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3 col-12">
                    <label class="form-label fw-bold">Address Line 1</label>
                    <input type="text" class="form-control" wire:model="address_line1">
                    @error('address_line1') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3 col-12">
                    <label class="form-label fw-bold">Address Line 2</label>
                    <input type="text" class="form-control" wire:model="address_line2">
                    @error('address_line2') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">State</label>
                    <input type="text" class="form-control" wire:model="state">
                    @error('state') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Country</label>
                    <input type="text" class="form-control" wire:model="country">
                    @error('country') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Zip / Postal Code</label>
                    <input type="text" class="form-control" wire:model="postal_code">
                    @error('postal_code') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                <div wire:loading wire:target="saveProfile" class="ms-2">
                    <span class="spinner-border spinner-border-sm text-primary"></span> Saving...
                </div>
            </div>
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