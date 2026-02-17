<div>
    <form wire:submit.prevent="update">
        <div class="row">
            <div class="col-md-9">

                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label">Page Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                        wire:model.defer="title" placeholder="Enter page title">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Slug -->
                <div class="mb-3">
                    <label class="form-label">Slug <span class="text-muted">(leave it blank to
                            auto-generate)</span></label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" wire:model.defer="slug"
                        placeholder="auto-generated-slug">
                    @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label">Short Description</label>
                    <textarea class="form-control" wire:model.defer="short_description" rows="4"
                        placeholder="Optional description..."></textarea>
                </div>


                <!-- Description -->
                <div class="mb-3" wire:ignore>
                    <label class="form-label">Long Description</label>
                    <textarea id="editor" class="form-control" placeholder="Optional description..."
                        rows="4">{{ $description }}</textarea>
                </div>


                <!-- Submit -->
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Update Page</span>
                        <span wire:loading>Saving...</span>
                    </button>
                </div>

            </div>
            <div class="col-md-3">

<!-- Thumbnail -->
                <div class="mb-3">
                    <label>Thumbnail</label>
                    <div class="image-box my-1">
                        @if ($thumbnail)
                        <img src="{{ $thumbnail->temporaryUrl() }}" alt="Preview">
                        @elseif($page->thumbnail)
                        <img src="{{ asset('storage/'.$page->thumbnail) }}">
                        @else
                        <span>No Thumbnail Uploaded</span>
                        @endif

                        <label for="thumbnailInput" class="edit-btn">
                            <i class="lni lni-brush-2"></i>
                        </label>
                        <input type="file" wire:model="thumbnail" id="thumbnailInput" class="hidden-input"
                            style="display:none" accept="image/png, image/jpeg, image/webp">
                    </div>
                    <small class="text-muted">PNG, WEBP and JPG - Max: 2048KB</small><br>
                    @error('thumbnail') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Cover -->
                <div class="mb-3">
                    <label>Cover Image</label>
                    <div class="image-box my-1">
                        @if ($cover_image)
                        <img src="{{ $cover_image->temporaryUrl() }}" alt="Preview">
                        @elseif($page->cover_image)
                        <img src="{{ asset('storage/'.$page->cover_image) }}">
                        @else
                        <span>No Cover Image Uploaded</span>
                        @endif

                        <label for="coverImageInput" class="edit-btn">
                            <i class="lni lni-brush-2"></i>
                        </label>
                        <input type="file" wire:model="cover_image" id="coverImageInput" class="hidden-input"
                            style="display:none" accept="image/png, image/jpeg, image/webp">
                    </div>
                    <small class="text-muted">PNG, WEBP and JPG - Max: 2048KB</small><br>
                    @error('cover_image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Flags -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_featured_checkbox"
                        wire:model.defer="is_featured" >
                    <label class="form-check-label" for="is_featured_checkbox">Is Featured?</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_active_checkbox"
                        wire:model.defer="is_active">
                    <label class="form-check-label" for="is_active_checkbox">Is Active?</label>
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

@push('scripts')


<script>
    document.addEventListener('livewire:init', function () {
        ClassicEditor.create(document.querySelector('#editor'), {

            toolbar: [
                'heading',
                '|',
                'bold',
                'italic',
                'link',
                'bulletedList',
                'numberedList',
                '|',
                'blockQuote',
                'undo',
                'redo'
            ]

        })
            .then(editor => {

                editor.model.document.on('change:data', () => {
                    @this.set('description', editor.getData());
                });

                // Optional: Reset editor after save
                Livewire.on('resetEditor', () => {
                    editor.setData('');
                });

            })
            .catch(error => {
                console.error(error);
            });
    });
</script>
@endpush