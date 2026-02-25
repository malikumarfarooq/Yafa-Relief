<div>
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-md-9">
                <!-- Title -->
                <div class="mb-3">
                    <label class="form-label">Slide Title <sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                        wire:model.defer="title" placeholder="Enter slide title">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Subtitle -->
                <div class="mb-3">
                    <label class="form-label">Subtitle</label>
                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                        wire:model.defer="subtitle" placeholder="Enter subtitle">
                    @error('subtitle')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" wire:model.defer="description" rows="4"
                        placeholder="Enter description"></textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Button Text and URL -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" class="form-control @error('button_text') is-invalid @enderror"
                            wire:model.defer="button_text" placeholder="e.g. Donate Now">
                        @error('button_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" class="form-control @error('button_url') is-invalid @enderror"
                            wire:model.defer="button_url" placeholder="e.g. /donate">
                        @error('button_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Order and Status -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Order</label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror"
                            wire:model.defer="order" min="0" placeholder="Display order">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" wire:model.defer="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Create Slide</span>
                        <span wire:loading>Saving...</span>
                    </button>
                </div>
            </div>

            <div class="col-md-3">
                <!-- Media Type -->
                <div class="mb-3">
                    <label class="form-label">Media Type <sup class="text-danger">*</sup></label>
                    <select class="form-select @error('media_type') is-invalid @enderror" wire:model.live="media_type">
                        <option value="image">Image</option>
                        <option value="video">Video</option>
                    </select>
                    @error('media_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Main Media -->
                <label>{{ $media_type === 'image' ? 'Image' : 'Video' }} <sup class="text-danger">*</sup></label>
                <div class="image-box my-1">
                    @if ($media && $media_type === 'image')
                        <img src="{{ $media->temporaryUrl() }}" alt="Preview">
                    @elseif ($media && $media_type === 'video')
                        <span class="text-success">{{ $media->getClientOriginalName() }}</span>
                    @else
                        <span>No {{ $media_type }} uploaded</span>
                    @endif

                    <label for="mediaInput" class="edit-btn">
                        <i class="lni lni-brush-2"></i>
                    </label>
                    <input type="file" wire:model="media" id="mediaInput" class="hidden-input" style="display:none"
                        accept="{{ $media_type === 'image' ? 'image/*' : 'video/*' }}">
                </div>
                <small class="text-muted">
                    {{ $media_type === 'image' ? 'PNG, JPEG, JPG, WEBP, GIF' : 'MP4, WebM, OGG' }}
                </small><br>
                @error('media')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <br>

                <!-- Mobile Media -->
                <label>Mobile {{ $media_type === 'image' ? 'Image' : 'Video' }} <span
                        class="text-muted">(optional)</span></label>
                <div class="image-box my-1">
                    @if ($mobile_media && $media_type === 'image')
                        <img src="{{ $mobile_media->temporaryUrl() }}" alt="Preview">
                    @elseif ($mobile_media && $media_type === 'video')
                        <span class="text-success">{{ $mobile_media->getClientOriginalName() }}</span>
                    @else
                        <span>No mobile {{ $media_type }} uploaded</span>
                    @endif

                    <label for="mobileMediaInput" class="edit-btn">
                        <i class="lni lni-brush-2"></i>
                    </label>
                    <input type="file" wire:model="mobile_media" id="mobileMediaInput" class="hidden-input"
                        style="display:none" accept="{{ $media_type === 'image' ? 'image/*' : 'video/*' }}">
                </div>
                <small class="text-muted">Optional - for mobile devices</small><br>
                @error('mobile_media')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </form>

    @if (session()->has('success'))
        <div class="alert alert-success mt-3 d-flex justify-content-between align-items-center gap-3"
            style="position: fixed; bottom: 0px; right: 40px; z-index: 9999;">
            <span class="pe-5">{{ session('success') }}</span>
        </div>
    @endif
</div>
