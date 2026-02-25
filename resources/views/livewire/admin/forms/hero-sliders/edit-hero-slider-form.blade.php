<div>
    <form wire:submit.prevent="update">
        <div class="row">
            <div class="col-md-9">
                <!-- Title -->
                <div class="mb-3">
                    <label class="form-label">Title <sup class="text-danger">*</sup></label>
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

                <!-- Order and Status Row -->
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

                <!-- Submit -->
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Update Slide</span>
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

                <!-- Current Media Display -->
                @if ($heroSlider->media_path)
                    <div class="mb-3">
                        <label class="form-label">Current Media</label>
                        <div class="image-box my-1">
                            @if ($heroSlider->media_type === 'image')
                                <img src="{{ asset('storage/' . $heroSlider->media_path) }}" alt="Current Media">
                            @else
                                <video src="{{ asset('storage/' . $heroSlider->media_path) }}" controls
                                    style="max-height:150px;"></video>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Replace Media -->
                <div class="mb-3">
                    <label class="form-label">Replace {{ ucfirst($media_type) }} (optional)</label>
                    <div class="image-box my-1">
                        @if ($media)
                            @if ($media_type === 'image')
                                <img src="{{ $media->temporaryUrl() }}" alt="Preview">
                            @else
                                <span class="p-3 d-block text-center">Video:
                                    {{ $media->getClientOriginalName() }}</span>
                            @endif
                        @else
                            <span>No new {{ $media_type }} selected</span>
                        @endif

                        <label for="mediaInput" class="edit-btn">
                            <i class="lni lni-brush-2"></i>
                        </label>
                        <input type="file" wire:model="media" id="mediaInput" class="hidden-input"
                            style="display:none" accept="{{ $media_type === 'image' ? 'image/*' : 'video/*' }}">
                    </div>
                    <small class="text-muted">{{ $media_type === 'image' ? 'PNG, WEBP and JPG' : 'MP4, WebM etc' }} -
                        Max: 10MB</small><br>
                    @error('media')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Mobile Media -->
                <div class="mb-3">
                    <label class="form-label">Mobile Media (optional)</label>

                    @if ($heroSlider->mobile_media_path && !$mobile_media)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $heroSlider->mobile_media_path) }}" class="img-thumbnail"
                                style="max-height:60px; width:100%; object-fit:cover;">
                        </div>
                    @endif

                    <div class="image-box my-1">
                        @if ($mobile_media)
                            <img src="{{ $mobile_media->temporaryUrl() }}" alt="Mobile Preview">
                        @elseif(!$heroSlider->mobile_media_path)
                            <span>No mobile media</span>
                        @endif

                        <label for="mobileMediaInput" class="edit-btn">
                            <i class="lni lni-brush-2"></i>
                        </label>
                        <input type="file" wire:model="mobile_media" id="mobileMediaInput" class="hidden-input"
                            style="display:none" accept="image/*">
                    </div>
                    <small class="text-muted">PNG, WEBP and JPG - Max: 2048KB</small><br>
                    @error('mobile_media')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
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
