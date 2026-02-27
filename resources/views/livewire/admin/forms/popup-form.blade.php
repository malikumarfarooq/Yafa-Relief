<div>
    <form wire:submit.prevent="save">

        <div class="row">

            {{-- ── LEFT: Main Fields ── --}}
            <div class="col-md-9">

                {{-- Resource Linking --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Link to a Program <span class="text-muted">(optional)</span></label>
                        {{-- <select class="form-control" wire:model="resource_type" --}}
                        <select class="form-control" wire:model="resource_type">
                            wire:change="updatedResourceType($event.target.value)">
                            <option value="">-- Manual / No Link --</option>
                            <option value="program">Program</option>
                        </select>
                        <small class="text-muted">Selecting a program auto-fills the fields below</small>
                    </div>

                    @if ($resource_type && !empty($resourceList))
                        <div class="col-md-5">
                            <label class="form-label">Select {{ ucfirst($resource_type) }}</label>
                            {{-- <select class="form-control" wire:model="resource_id"
                                wire:change="updatedResourceId($event.target.value)"> --}}
                            <select class="form-control" wire:model="resource_id">
                                <option value="">-- Choose {{ ucfirst($resource_type) }} --</option>
                                @foreach ($resourceList as $r)
                                    <option value="{{ $r['id'] }}"
                                        {{ (string) $resource_id === (string) $r['id'] ? 'selected' : '' }}>
                                        {{ $r['title'] }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Fields will auto-fill when you select</small>
                        </div>
                    @endif
                </div>

                <hr class="my-3">

                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label">Popup Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                        wire:model.defer="title" placeholder="Enter popup title">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Short Description --}}
                <div class="mb-3">
                    <label class="form-label">Short Description
                        <span class="text-muted">(shown on right side of popup)</span>
                    </label>
                    <textarea class="form-control" wire:model.defer="short_description" rows="3"
                        placeholder="Brief text shown to the user..."></textarea>
                    @error('short_description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Long Description --}}
                <div class="mb-3">
                    <label class="form-label">Long Description
                        <span class="text-muted">(shown on left side of popup)</span>
                    </label>
                    <textarea class="form-control" wire:model.defer="description" rows="6" placeholder="Full description..."></textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Button Text + Redirect URL --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Button Text <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('button_text') is-invalid @enderror"
                            wire:model.defer="button_text" placeholder="Make an Impact">
                        @error('button_text')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Redirect URL
                            <span class="text-muted">(auto-filled when program selected)</span>
                        </label>
                        <input type="text" class="form-control @error('redirect_url') is-invalid @enderror"
                            wire:model.defer="redirect_url" placeholder="/programs/your-program-slug">
                        @error('redirect_url')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Cooldown + Display Order --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Cooldown Hours <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('cooldown_hours') is-invalid @enderror"
                            wire:model.defer="cooldown_hours" min="1">
                        <small class="text-muted">Hours before popup shows again to same user</small>
                        @error('cooldown_hours')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Display Order</label>
                        <input type="number" class="form-control @error('display_order') is-invalid @enderror"
                            wire:model.defer="display_order" min="0">
                        <small class="text-muted">Lower number = higher priority</small>
                        @error('display_order')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Schedule --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Start Date/Time <span class="text-muted">(optional)</span></label>
                        <input type="datetime-local" class="form-control" wire:model.defer="starts_at">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">End Date/Time <span class="text-muted">(optional)</span></label>
                        <input type="datetime-local" class="form-control" wire:model.defer="ends_at">
                    </div>
                </div>

            </div>

            {{-- ── RIGHT: Images + Flags ── --}}
            <div class="col-md-3">

                {{-- Thumbnail --}}
                <div class="mb-3">
                    <label class="form-label">Thumbnail</label>
                    <div class="image-box my-1">
                        @if ($newThumbnail)
                            <img src="{{ $newThumbnail->temporaryUrl() }}" alt="Preview">
                        @elseif ($existingThumbnail)
                            <img src="{{ asset('storage/' . $existingThumbnail) }}" alt="Thumbnail">
                        @else
                            <span>No Thumbnail</span>
                        @endif
                        <label for="popupThumbnailInput" class="edit-btn">
                            <i class="lni lni-brush-2"></i>
                        </label>
                        <input type="file" wire:model="newThumbnail" id="popupThumbnailInput"
                            style="display:none" accept="image/png, image/jpeg, image/webp">
                    </div>
                    <small class="text-muted">PNG, WEBP, JPG — Max 2048KB</small>
                    @error('newThumbnail')
                        <br><small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Cover Image --}}
                <div class="mb-3">
                    <label class="form-label">Cover Image
                        <span class="text-muted">(shown in popup)</span>
                    </label>
                    <div class="image-box my-1">
                        @if ($newCoverImage)
                            <img src="{{ $newCoverImage->temporaryUrl() }}" alt="Preview">
                        @elseif ($existingCoverImage)
                            <img src="{{ asset('storage/' . $existingCoverImage) }}" alt="Cover">
                        @else
                            <span>No Cover Image</span>
                        @endif
                        <label for="popupCoverInput" class="edit-btn">
                            <i class="lni lni-brush-2"></i>
                        </label>
                        <input type="file" wire:model="newCoverImage" id="popupCoverInput" style="display:none"
                            accept="image/png, image/jpeg, image/webp">
                    </div>
                    <small class="text-muted">PNG, WEBP, JPG — Max 2048KB</small>
                    @error('newCoverImage')
                        <br><small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Is Active --}}
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" id="popup_is_active"
                        wire:model.defer="is_active">
                    <label class="form-check-label" for="popup_is_active">Is Active?</label>
                </div>
                <small class="text-muted d-block mt-1">Only one active popup shows at a time (lowest display order
                    wins)</small>

            </div>

        </div>

        {{-- Submit --}}
        <button class="btn btn-dark px-4 mt-4" type="submit" wire:loading.attr="disabled">
            <span wire:loading.remove>{{ $popupId ? 'Update Popup' : 'Create Popup' }}</span>
            <span wire:loading>Saving...</span>
        </button>

    </form>

    @if (session()->has('success'))
        <div class="alert alert-success mt-3 d-flex justify-content-between align-items-center gap-3"
            style="position:fixed; bottom:0; right:40px; z-index:9999;">
            <span class="pe-5">{{ session('success') }}</span>
            <span style="font-size:48px" class="position-absolute top-50 start-100 translate-middle">😎</span>
        </div>
    @endif
</div>
