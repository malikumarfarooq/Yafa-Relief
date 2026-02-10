<div>
    <form wire:submit.prevent="save">

        <div class="row">
            <div class="col-md-9">

                <!-- Title -->
                <div class="mb-3">
                    <label class="form-label">Program Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                        wire:model.defer="title">
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror

                </div>


                <div class="row">
                    <!-- Short Description -->
                    <div class="col-md-6 mb-3">
                        <!-- Slug -->
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                wire:model.defer="slug">
                            @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Short Description</label>
                            <textarea class="form-control h-auto pb-3" rows="6"
                                wire:model.defer="short_description"></textarea>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Long Description</label>
                        <textarea class="form-control h-auto" rows="10" wire:model.defer="description"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Legacy Message</label>
                        <textarea class="form-control h-auto" rows="3" wire:model.defer="legacy_message"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Our Promises <span class="text-muted">(use <code>||</code> to seprate
                                the promises)</span></label>
                        <textarea class="form-control h-auto" rows="3" wire:model.defer="promises"></textarea>
                    </div>
                </div>

                <!-- Financials -->
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Goal Amount</label>
                        <input type="number" class="form-control @error('goal_amount') is-invalid @enderror"
                            wire:model.defer="goal_amount">
                        @error('goal_amount') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Minimum Donation Amount</label>
                        <input type="number" class="form-control" wire:model.defer="min_amount">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Amount Options (comma separated)</label>
                        <input type="text" class="form-control" wire:model.defer="amount_options">
                    </div>
                </div>

                <!-- Dates -->
                <div class="row mt-3">
                    <div class="col-md-3">
                        <label class="form-label">Start Date</label>
                        <input type="datetime-local" class="form-control @error('start_date') is-invalid @enderror"
                            wire:model.defer="start_date">
                        @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">End Date</label>
                        <input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror"
                            wire:model.defer="end_date">
                        @error('end_date') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

            </div>

            <div class="col-md-3">

                <!-- Thumbnail -->
                <div class="mb-3">
                    <label>Thumbnail</label>
                    <div class="image-box my-1">
                        @if ($thumbnail)
                        <img src="{{ $thumbnail->temporaryUrl() }}" alt="Preview">
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
                        wire:model.defer="is_featured">
                    <label class="form-check-label" for="is_featured_checkbox">Is Featured?</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_recurring_checkbox"
                        wire:model.defer="is_recurring_allowed">
                    <label class="form-check-label" for="is_recurring_checkbox">Allow Recurring Donations?</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_active_checkbox"
                        wire:model.defer="is_active">
                    <label class="form-check-label" for="is_active_checkbox">Is Active?</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_urgent_checkbox"
                        wire:model.defer="is_urgent">
                    <label class="form-check-label" for="is_urgent_checkbox">Is Urgent?</label>
                </div>
                <div class="text-muted my-3">Program Categories</div>
                @forelse($categories as $cat)
                <div class="form-check">
                    <input class="form-check-input" id="category_{{ $cat->id }}" type="checkbox"
                        wire:model.defer="selected_categories" value="{{ $cat->id }}">
                    <label class="form-check-label" for="category_{{ $cat->id }}">{{ $cat->name }}</label>
                </div>
                @empty
                <div class="text-muted"><small><i>No categories available</i></small></div>
                @endforelse
                @error('selected_categories')
                <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>
        </div>

        <button class="btn btn-primary mt-4" type="submit">
            Create Program
        </button>

    </form>

    @if (session()->has('success'))
    <div class="alert alert-success mt-3 d-flex justify-content-between align-items-center gap-3"
        style="position: fixed; bottom: 0px; right: 40px; z-index: 9999;">
        <span class="pe-5">{{ session('success') }}</span> <span style="font-size: 48px"
            class="position-absolute top-50 start-100 translate-middle">😎</span>
    </div>
    @endif
</div>