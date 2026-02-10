<div>
    <form wire:submit.prevent="submit">
        <div class="row">
            <div class="col-md-12">
                <div class="row">

                    <!-- Role Name -->
                    <div class="col-md-3 form-group">
                        <label class="form-label">Role</label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               wire:model.defer="name"
                               placeholder="Enter role name">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-md-9 form-group">
                        <label class="form-label">Description</label>
                        <input type="text"
                               class="form-control"
                               wire:model.defer="description"
                               placeholder="Enter role description...">
                    </div>

                    <div class="col-md-12 my-4 d-flex align-items-baseline justify-content-between">
                        <h5 class="fw-bold mb-3 fs-16">Manage Permissions</h5>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            Save
                        </button>
                    </div>

                    <!-- Permissions -->
                    <div class="col-md-12 mb-3">
                        <div class="permission-section">

                            @foreach($allPermissions->groupBy('group') as $group => $permissions)
                                <h5 class="highlight-text fs-16 mb-3">
                                    {{ ucfirst(str_replace('_', ' ', $group)) }}
                                </h5>

                                <div class="d-flex flex-wrap gap-4 mb-3">
                                    @foreach($permissions as $permission)
                                        <div class="form-check d-flex align-items-start gap-3 mb-2">
                                            <input class="form-check-input mt-0"
                                                   type="checkbox"
                                                   wire:model="permissions"
                                                   value="{{ $permission->name }}"
                                                   id="perm_{{ $permission->id }}">

                                            <label class="form-check-label" for="perm_{{ $permission->id }}">
                                                {{ ucwords(str_replace('.', ' ', $permission->title)) }}
                                                <br>
                                                <small class="text-muted">
                                                    Allows {{ str_replace('.', ' ', $permission->description) }}
                                                </small>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach

                        </div>
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
