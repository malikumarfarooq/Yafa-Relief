<div>
    @if (session()->has('success'))
        <div class="alert alert-success" style="position:fixed;bottom:20px;right:40px;z-index:9999;">
            {{ session('success') }}
        </div>
    @endif
    <form wire:submit.prevent="save">
        <div class="mb-3">
            <label class="form-label">Popup Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model.defer="title"
                placeholder="Enter popup title">
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Link to Resource</label>
                        <select class="form-control" wire:model.live="resource_type">
                            <option value="">-- Manual / No Link --</option>
                            <option value="program">Program</option>
                        </select>
                        <small class="text-muted">Auto-fills when selected</small>
                    </div>
                    @if ($resource_type && !empty($resourceList))
                        <div class="col-md-8 mb-3">
                            <label class="form-label">
                                Select {{ ucfirst($resource_type) }}
                            </label>
                            <select class="form-control" wire:model.live="resource_id">
                                <option value="">
                                    -- Choose {{ ucfirst($resource_type) }} -
                                </option>
                                @foreach ($resourceList as $r)
                                    <option value="{{ $r['id'] }}"
                                        {{ (string) $resource_id === (string) $r['id'] ? 'selected' : '' }}>
                                        {{ $r['title'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Short Description</label>
                        <textarea class="form-control h-auto pb-3" rows="6" wire:model.defer="short_description"
                            placeholder="Brief text..."></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Long Description</label>
                        <textarea class="form-control h-auto" rows="6" wire:model.defer="description" placeholder="Full description..."></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Button Text *</label>
                        <input type="text" class="form-control" wire:model.defer="button_text"
                            placeholder="Make an Impact">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Redirect URL</label>
                        <input type="text" class="form-control" wire:model.defer="redirect_url"
                            placeholder="/programs/your-slug">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Cooldown Hours *</label>
                        <input type="number" class="form-control" wire:model.defer="cooldown_hours" min="1">
                        <small class="text-muted">
                            Hours before popup shows again
                        </small>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Display Order</label>
                        <input type="number" class="form-control" wire:model.defer="display_order" min="0">
                        <small class="text-muted">Lower = higher priority</small>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Start Date (optional)</label>
                        <input type="datetime-local" class="form-control" wire:model.defer="starts_at">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">End Date (optional)</label>
                        <input type="datetime-local" class="form-control" wire:model.defer="ends_at">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label>Thumbnail</label>
                    <div class="image-box my-1">
                        @if ($newThumbnail)
                            <img src="{{ $newThumbnail->temporaryUrl() }}" alt="Preview">
                        @elseif ($existingThumbnail)
                            <img src="{{ asset('storage/' . $existingThumbnail) }}" alt="Thumbnail">
                        @else
                            <span>No Thumbnail Uploaded</span>
                        @endif
                        <label for="popupThumbnailInput" class="edit-btn">
                            <i class="lni lni-brush-2"></i>
                        </label>
                        <input type="file" wire:model="newThumbnail" id="popupThumbnailInput" style="display:none"
                            accept="image/png,image/jpeg,image/webp">
                    </div>
                    <small class="text-muted">
                        PNG, WEBP and JPG - Max: 2048KB
                    </small>
                    @error('newThumbnail')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Cover Image</label>
                    <div class="image-box my-1">
                        @if ($newCoverImage)
                            <img src="{{ $newCoverImage->temporaryUrl() }}" alt="Preview">
                        @elseif ($existingCoverImage)
                            <img src="{{ asset('storage/' . $existingCoverImage) }}" alt="Cover">
                        @else
                            <span>No Cover Image Uploaded</span>
                        @endif
                        <label for="popupCoverInput" class="edit-btn">
                            <i class="lni lni-brush-2"></i>
                        </label>
                        <input type="file" wire:model="newCoverImage" id="popupCoverInput" style="display:none"
                            accept="image/png,image/jpeg,image/webp">
                    </div>
                    <small class="text-muted">
                        PNG, WEBP and JPG - Max: 2048KB
                    </small>
                    @error('newCoverImage')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="popup_is_active"
                        wire:model.defer="is_active">
                    <label class="form-check-label" for="popup_is_active">
                        Is Active?
                    </label>
                </div>
                <small class="text-muted d-block mt-1">
                    Only one active popup shows on frontend
                </small>
            </div>
        </div>
        <button class="btn btn-dark mt-4" type="submit" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="save">
                {{ $popupId ? 'Update Popup' : 'Create Popup' }}
            </span>
            <span wire:loading wire:target="save">Saving...</span>
        </button>
    </form>
</div>
