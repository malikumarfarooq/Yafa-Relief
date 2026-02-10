<div>
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-md-9">

                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label">Attribute Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.defer="name"
                        placeholder="Enter attribute name">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Slug -->
                <div class="mb-3">
                    <label class="form-label">Slug <span class="text-muted">(leave it blank to auto-generate)</span></label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" wire:model.defer="slug"
                        placeholder="auto-generated-slug">
                    @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" wire:model.defer="description" rows="4"
                        placeholder="Optional description..."></textarea>
                </div>

                <!-- Submit -->
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Create Attribute</span>
                        <span wire:loading>Saving...</span>
                    </button>
                </div>

            </div>
            <div class="col-md-3">

                <label>Thumbnail</label>
                <div class="image-box my-1">
                    @if ($avatar)
                    <img src="{{ $avatar->temporaryUrl() }}" alt="Preview">
                    @else
                    <span>No Thumbnail Uploaded</span>
                    @endif

                    <label for="logoInput" class="edit-btn">
                        <i class="lni lni-brush-2"></i>
                    </label>
                    <input type="file" wire:model="avatar" id="logoInput" class="hidden-input" style="display:none"
                        accept="image/png, image/jpeg">
                </div>
                <small class="text-muted">PNG and JPG with transparent background - Max: 1024KB</small><br>
                @error('avatar') <small class="text-danger">{{ $message }}</small> @enderror
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