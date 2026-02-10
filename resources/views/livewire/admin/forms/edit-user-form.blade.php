<div>
    <form wire:submit.prevent="update">
        <div class="row">
            <!-- LEFT SIDE -->
            <div class="col-md-8">
                <div class="row g-3">

                    <!-- First Name -->
                    <div class="col-md-6 form-group">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control @error('f_name') is-invalid @enderror"
                            wire:model.defer="f_name" placeholder="Enter first name">
                        @error('f_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div class="col-md-6 form-group">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control @error('l_name') is-invalid @enderror"
                            wire:model.defer="l_name" placeholder="Enter last name">
                        @error('l_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="col-md-6 form-group">
                        <label class="form-label">Role</label>
                        <select class="form-select @error('role') is-invalid @enderror" wire:model.defer="role">
                            <option value="">Select role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->name }}">
                                {{ ucfirst($role->name) }}
                            </option>
                            @endforeach
                        </select>
                        @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 form-group">
                        <label class="form-label">Status</label>
                        <select class="form-select" wire:model.defer="is_active">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            wire:model.defer="email" placeholder="Enter email address">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="col-md-6 form-group">
                        <label class="form-label">Password <span class="text-muted">(Leave blank to keep current password)</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            wire:model.defer="password" placeholder="Enter password">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6 form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                            wire:model.defer="phone" placeholder="Enter phone number">
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Submit -->
                <div class="my-4">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Update User</span>
                        <span wire:loading>Updating...</span>
                    </button>

                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div class="col-md-4">
                <div class="profile-picture-section d-flex align-items-center mt-4 d-none">
                    <img src="/admin-assets/images/user-placeholder.jpg" alt="Profile Picture"
                        class="profile-picture me-3">
                    <div>
                        <button type="button" class="btn btn-outline-primary btn-sm mb-2 p-1" disabled>
                            Change Picture
                        </button>
                        <br>
                        <button type="button" class="btn btn-outline-danger btn-sm p-1" disabled>
                            Remove Picture
                        </button>
                        <small class="d-block text-muted mt-2">
                            Avatar upload coming soon
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @if (session()->has('success'))
    <div class="alert alert-success mt-3 d-flex justify-content-between align-items-center gap-3"
        style="position: fixed; bottom: 0px; right: 40px; z-index: 9999;">
        <span class="pe-5">{{ session('success') }}</span> <span style="font-size: 48px"
            class="position-absolute top-50 start-100 translate-middle">😎</span>
    </div>
    @endif
</div>