<div class="row g-4">

    {{-- ── Left Sidebar ── --}}
    {{-- <div class="col-md-3"> --}}

    <div class="col-md-2">
        {{-- <div class="card border-0 shadow-sm rounded-3 p-3"> --}}
        <div class="card border-0 shadow-sm rounded-3 p-3">
            <p class="text-muted mb-2" style="font-size: 13px;">— Manage Popups</p>
            <a href="{{ route('admin.popups.create') }}" class="d-block mb-1 text-decoration-none"
                style="font-size: 14px; {{ request()->routeIs('admin.popups.create') ? 'color: #e74c3c; font-weight: 600;' : 'color: #212529;' }}">
                Create Popup
            </a>
            <a href="{{ route('admin.popups.index') }}" class="d-block text-decoration-none"
                style="font-size: 14px; {{ request()->routeIs('admin.popups.index') ? 'color: #e74c3c; font-weight: 600;' : 'color: #212529;' }}">
                All Popups
            </a>
        </div>
    </div>

    {{-- ── Main Content ── --}}
    <div class="col-md-9">
        <div class="card border-0 shadow-sm rounded-3 p-4">

            {{-- Header --}}
            <h5 class="mb-4 d-flex align-items-center gap-2" style="font-size: 18px; font-weight: 600;">
                <span style="color: #e74c3c; font-size: 20px;">⊕</span>
                {{ $popupId ? 'Edit Popup' : 'Create a new Popup' }}
            </h5>

            <form wire:submit.prevent="save">
                <div class="row g-4">

                    {{-- ── Left Form Fields ── --}}
                    <div class="col-md-9">

                        {{-- Popup Title --}}
                        <div class="mb-3">
                            <label class="form-label" style="font-size: 14px; font-weight: 500;">Popup Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                wire:model.defer="title" placeholder="Enter popup title">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Short Description --}}
                        <div class="mb-3">
                            <label class="form-label" style="font-size: 14px; font-weight: 500;">Short
                                Description</label>
                            <textarea class="form-control" wire:model.defer="short_description" rows="3"
                                placeholder="Optional description..."></textarea>
                        </div>

                        {{-- Long Description --}}
                        <div class="mb-3" wire:ignore>
                            <label class="form-label" style="font-size: 14px; font-weight: 500;">Long
                                Description</label>
                            <textarea id="editor" class="form-control" placeholder="Optional description..." rows="4">{{ $description }}</textarea>
                        </div>

                        {{-- Button Text & Redirect URL --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" style="font-size: 14px; font-weight: 500;">Button Text</label>
                                <input type="text" class="form-control @error('button_text') is-invalid @enderror"
                                    wire:model.defer="button_text" placeholder="Make an Impact">
                                @error('button_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="font-size: 14px; font-weight: 500;">Redirect
                                    URL</label>
                                <input type="text" class="form-control @error('redirect_url') is-invalid @enderror"
                                    wire:model.defer="redirect_url" placeholder="/programs/sample-program">
                                @error('redirect_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Cooldown Hours & Display Order --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" style="font-size: 14px; font-weight: 500;">Cooldown
                                    Hours</label>
                                <input type="number" class="form-control @error('cooldown_hours') is-invalid @enderror"
                                    wire:model.defer="cooldown_hours" min="1">
                                <small class="text-muted" style="font-size: 12px;">Hours before popup shows again to
                                    same user</small>
                                @error('cooldown_hours')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="font-size: 14px; font-weight: 500;">Display
                                    Order</label>
                                <input type="number" class="form-control @error('display_order') is-invalid @enderror"
                                    wire:model.defer="display_order" min="0">
                                <small class="text-muted" style="font-size: 12px;">Lower numbers display first</small>
                                @error('display_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Schedule --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" style="font-size: 14px; font-weight: 500;">Start
                                    Date/Time</label>
                                <input type="datetime-local"
                                    class="form-control @error('starts_at') is-invalid @enderror"
                                    wire:model.defer="starts_at">
                                @error('starts_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="font-size: 14px; font-weight: 500;">End
                                    Date/Time</label>
                                <input type="datetime-local" class="form-control @error('ends_at') is-invalid @enderror"
                                    wire:model.defer="ends_at">
                                @error('ends_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="mt-4">
                            <button type="submit" class="btn btn-dark px-4 py-2"
                                style="font-size: 14px; font-weight: 500;" wire:loading.attr="disabled">
                                <span wire:loading.remove>
                                    {{ $popupId ? 'Update Popup' : 'Create Popup' }}
                                </span>
                                <span wire:loading>Saving...</span>
                            </button>
                        </div>

                    </div>{{-- /col-md-9 --}}

                    {{-- ── Right: Images & Flags ── --}}
                    <div class="col-md-3">

                        {{-- Thumbnail --}}
                        <label class="form-label" style="font-size: 14px; font-weight: 500;">Thumbnail</label>
                        <div class="image-box my-1">
                            @if ($thumbnailImage)
                                <img src="{{ $thumbnailImage->temporaryUrl() }}" alt="Preview">
                            @elseif ($existingThumbnail)
                                <img src="{{ Storage::url($existingThumbnail) }}" alt="Thumbnail">
                            @else
                                <span>No Thumbnail Uploaded</span>
                            @endif
                            <label for="thumbnailInput" class="edit-btn">
                                <i class="lni lni-brush-2"></i>
                            </label>
                            <input type="file" wire:model="thumbnailImage" id="thumbnailInput"
                                style="display:none" accept="image/png, image/jpeg, image/webp, image/jpg, image/gif">
                        </div>
                        <small class="text-muted" style="font-size: 12px;">PNG, WEBP, GIF, JPEG and JPG - Max:
                            1024KB</small><br>
                        @error('thumbnailImage')
                            <small class="text-danger" style="font-size: 12px;">{{ $message }}</small>
                        @enderror

                        {{-- Cover Image --}}
                        <label class="form-label mt-3" style="font-size: 14px; font-weight: 500;">Cover Image</label>
                        <div class="image-box my-1">
                            @if ($coverImage)
                                <img src="{{ $coverImage->temporaryUrl() }}" alt="Preview">
                            @elseif ($existingCoverImage)
                                <img src="{{ Storage::url($existingCoverImage) }}" alt="Cover">
                            @else
                                <span>No Cover Image Uploaded</span>
                            @endif
                            <label for="coverImageInput" class="edit-btn">
                                <i class="lni lni-brush-2"></i>
                            </label>
                            <input type="file" wire:model="coverImage" id="coverImageInput" style="display:none"
                                accept="image/png, image/jpeg, image/webp, image/jpg, image/gif">
                        </div>
                        <small class="text-muted" style="font-size: 12px;">PNG, WEBP, GIF, JPEG and JPG - Max:
                            1024KB</small><br>
                        @error('coverImage')
                            <small class="text-danger" style="font-size: 12px;">{{ $message }}</small>
                        @enderror

                        {{-- Flags --}}
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" id="is_active_checkbox"
                                wire:model.defer="is_active">
                            <label class="form-check-label" for="is_active_checkbox" style="font-size: 14px;">Is
                                Active?</label>
                        </div>

                    </div>{{-- /col-md-3 --}}

                </div>{{-- /row --}}
            </form>

        </div>{{-- /card --}}
    </div>{{-- /col-md-9 --}}

</div>{{-- /row --}}

{{-- Success Toast --}}
@if (session()->has('success'))
    <div class="alert alert-success mt-3 d-flex justify-content-between align-items-center gap-3"
        style="position: fixed; bottom: 0px; right: 40px; z-index: 9999;">
        <span class="pe-5">{{ session('success') }}</span>
        <span style="font-size: 48px" class="position-absolute top-50 start-100 translate-middle">😎</span>
    </div>
@endif

@push('scripts')
    <script>
        document.addEventListener('livewire:init', function() {
            if (document.querySelector('#editor')) {
                ClassicEditor.create(document.querySelector('#editor'), {
                        toolbar: [
                            'heading', '|',
                            'bold', 'italic', 'link',
                            'bulletedList', 'numberedList', '|',
                            'blockQuote', 'undo', 'redo'
                        ]
                    })
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            @this.set('description', editor.getData());
                        });
                        Livewire.on('resetEditor', () => {
                            editor.setData('');
                        });
                    })
                    .catch(error => console.error(error));
            }
        });
    </script>
@endpush
