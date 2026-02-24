<div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-3">
        {{-- Title --}}
        <div class="col-md-6">
            <label class="form-label fw-500">Title <sup>*</sup></label>
            <input type="text" wire:model="title" class="form-control" placeholder="Enter slide title">
            @error('title')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        {{-- Subtitle --}}
        <div class="col-md-6">
            <label class="form-label fw-500">Subtitle</label>
            <input type="text" wire:model="subtitle" class="form-control" placeholder="Enter subtitle">
        </div>

        {{-- Description --}}
        <div class="col-12">
            <label class="form-label fw-500">Description</label>
            <textarea wire:model="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
        </div>

        {{-- Button Text --}}
        <div class="col-md-6">
            <label class="form-label fw-500">Button Text</label>
            <input type="text" wire:model="button_text" class="form-control" placeholder="e.g. Donate Now">
        </div>

        {{-- Button URL --}}
        <div class="col-md-6">
            <label class="form-label fw-500">Button URL</label>
            <input type="text" wire:model="button_url" class="form-control" placeholder="e.g. /donate">
        </div>

        {{-- Media Type --}}
        <div class="col-md-6">
            <label class="form-label fw-500">Media Type <sup>*</sup></label>
            <select wire:model.live="media_type" class="form-select">
                <option value="image">Image</option>
                <option value="video">Video</option>
            </select>
        </div>

        {{-- Order --}}
        <div class="col-md-3">
            <label class="form-label fw-500">Order</label>
            <input type="number" wire:model="order" class="form-control" min="0">
        </div>

        {{-- Status --}}
        <div class="col-md-3">
            <label class="form-label fw-500">Status</label>
            <select wire:model="status" class="form-select">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        {{-- Media Upload --}}
        <div class="col-md-6">
            <label class="form-label fw-500">
                {{ $media_type === 'image' ? 'Image' : 'Video' }} <sup>*</sup>
            </label>
            <input type="file" wire:model="media" class="form-control"
                accept="{{ $media_type === 'image' ? 'image/*' : 'video/*' }}">
            @error('media')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
            {{-- Preview --}}
            @if ($media)
                <div class="mt-2">
                    @if ($media_type === 'image')
                        <img src="{{ $media->temporaryUrl() }}" class="img-thumbnail" style="max-height: 150px;">
                    @else
                        <span class="text-success small">Video selected: {{ $media->getClientOriginalName() }}</span>
                    @endif
                </div>
            @endif
        </div>

        {{-- Mobile Media Upload --}}
        <div class="col-md-6">
            <label class="form-label fw-500">Mobile Image/Video (optional)</label>
            <input type="file" wire:model="mobile_media" class="form-control"
                accept="{{ $media_type === 'image' ? 'image/*' : 'video/*' }}">
            @if ($mobile_media)
                <div class="mt-2">
                    @if ($media_type === 'image')
                        <img src="{{ $mobile_media->temporaryUrl() }}" class="img-thumbnail" style="max-height: 150px;">
                    @else
                        <span class="text-success small">Video selected:
                            {{ $mobile_media->getClientOriginalName() }}</span>
                    @endif
                </div>
            @endif
        </div>

        {{-- Submit --}}
        <div class="col-12">
            <button wire:click="save" wire:loading.attr="disabled" class="btn btn-dark py-2 px-4">
                <span wire:loading wire:target="save">Saving...</span>
                <span wire:loading.remove wire:target="save">Save Slide</span>
            </button>
        </div>
    </div>
</div>
