<div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Search and Filter --}}
    <div class="d-flex justify-content-end align-items-center mb-3 gap-2">
        <input type="search" class="form-control form-control-sm rounded table-search" placeholder="Search by title..."
            wire:model.live.debounce.300ms="search">
        <button class="btn btn-dark py-2 px-2 fs-20" wire:click="toggleFilter" type="button">
            <i class="lni lni-funnel-1"></i>
        </button>
    </div>

    {{-- Filter Section --}}
    <form class="filter-section mb-3 px-3 py-2 border position-relative bg-light {{ $filter ? '' : 'd-none' }}"
        wire:submit.prevent>
        <div class="row table-filters-row">
            <div class="form-group col-md-3">
                <label class="form-label fw-500 mb-1">Slide Title</label>
                <input type="text" class="form-control form-control-sm" placeholder="Search by title"
                    wire:model.live="searchTitle">
            </div>
            <div class="form-group col-md-3">
                <label class="form-label fw-500 mb-1">Media Type</label>
                <select class="form-select form-select-sm" wire:model.live="mediaType">
                    <option value="">All Types</option>
                    <option value="image">Image</option>
                    <option value="video">Video</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label class="form-label fw-500 mb-1">Status</label>
                <select class="form-select form-select-sm" wire:model.live="status">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>

        <button type="button" wire:click="clearFilters"
            class="filter-reset-button btn btn-secondary position-absolute end-0 top-0 py-2">Reset</button>
        <button type="button" class="filter-action-button btn btn-dark py-2 position-absolute bottom-0 end-0"
            wire:click="applyFilters">Filter</button>
    </form>

    {{-- Drag and Drop Notice --}}
    {{-- <div class="alert alert-info py-2 mb-3 d-flex align-items-center gap-2">
        <i class="lni lni-move"></i>
        <small>Drag and drop rows using the <i class="lni lni-menu"></i> handle to reorder slides</small>
    </div> --}}

    {{-- Table --}}
    <div class="list-table-container">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 30px;"></th> {{-- Drag Handle --}}
                    <th style="width: 50px;">
                        <input class="form-check-input" type="checkbox"
                            wire:click="toggleSelectAll($event.target.checked)">
                    </th>
                    <th style="width: 60px;">Preview</th>
                    <th class="highlight-text">Title</th>
                    <th class="highlight-text">Status</th>
                    <th class="highlight-text">Type</th>
                    <th class="highlight-text">Order</th>
                </tr>
            </thead>
            <tbody id="sortable-sliders">
                @forelse($sliders as $slider)
                    <tr class="position-relative" wire:key="slider-{{ $slider->id }}" data-id="{{ $slider->id }}">
                        {{-- Drag Handle --}}
                        <td style="cursor: grab;" class="drag-handle">
                            <i class="lni lni-menu text-muted"></i>
                        </td>

                        {{-- Checkbox --}}
                        <td>
                            <input class="form-check-input" type="checkbox" wire:model="selectedSliders"
                                value="{{ $slider->id }}">
                        </td>

                        {{-- Preview Image --}}
                        <td>
                            <a href="{{ route('admin.hero-sliders.edit', $slider) }}" class="d-block">
                                @if ($slider->media_type === 'image')
                                    <img src="{{ asset('storage/' . $slider->media_path) }}" class="rounded"
                                        width="50" height="50" style="object-fit: cover;" alt="Slide">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px;">
                                        <i class="lni lni-play text-muted"></i>
                                    </div>
                                @endif
                            </a>
                        </td>

                        {{-- Title --}}
                        <td>
                            <a href="{{ route('admin.hero-sliders.edit', $slider) }}" class="user-name mb-0">
                                {{ $slider->title }}
                            </a>
                        </td>

                        {{-- Status --}}
                        <td>
                            @if ($slider->status === 'active')
                                <span class="badge bg-success rounded-pill px-3 py-2">Active</span>
                            @else
                                <span class="badge bg-secondary rounded-pill px-3 py-2">Inactive</span>
                            @endif
                        </td>

                        {{-- Type --}}
                        <td>
                            <span class="badge bg-light text-dark rounded-pill px-3 py-2">
                                {{ ucfirst($slider->media_type) }}
                            </span>
                        </td>

                        {{-- Order --}}
                        <td>
                            <span class="fw-medium">{{ $slider->order }}</span>
                        </td>

                        {{-- Floating Action Buttons --}}
                        <td class="position-absolute end-0 top-0 edit-button-td">
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.hero-sliders.edit', $slider) }}"
                                    class="btn btn-sm btn-link text-white p-0 text-decoration-none edit-button fs-20">
                                    <i class="lni lni-pen-to-square"></i>
                                </a>
                                <button wire:click="delete({{ $slider->id }})"
                                    wire:confirm="Are you sure you want to delete this slide?"
                                    class="btn btn-sm btn-link text-white p-0 text-decoration-none edit-button fs-20">
                                    <i class="lni lni-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="lni lni-image fs-1 d-block mb-3 opacity-50"></i>
                            No slides found. Create your first slide!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Bulk Actions --}}
    @if (count($selectedSliders) > 0)
        <div class="mt-2 mb-3">
            <span class="me-2">{{ count($selectedSliders) }} items selected</span>
            <button wire:click="deleteSelected" wire:confirm="Are you sure you want to delete selected items?"
                class="btn btn-sm btn-outline-danger">
                <i class="lni lni-trash-can"></i> Delete Selected
            </button>
        </div>
    @endif

    {{-- Pagination and Per Page --}}
    <nav class="pagination mt-3 mb-2 d-flex justify-content-end align-items-center">
        <select class="form-select form-select-sm me-2 rounded mt-0 py-2" style="width: auto;"
            wire:model.live="perPage">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>

        <ul class="pagination pb-0 mb-0">
            <li class="page-item {{ $sliders->onFirstPage() ? 'disabled' : '' }}">
                <a href="#" class="page-link text-dark" wire:click.prevent="previousPage">
                    Previous
                </a>
            </li>

            @for ($p = 1; $p <= $sliders->lastPage(); $p++)
                <li class="page-item {{ $sliders->currentPage() == $p ? 'active' : '' }}">
                    <a href="#"
                        class="page-link {{ $sliders->currentPage() == $p ? 'bg-dark text-white border-dark' : 'text-dark' }}"
                        wire:click.prevent="gotoPage({{ $p }})">
                        {{ $p }}
                    </a>
                </li>
            @endfor

            <li class="page-item {{ $sliders->currentPage() == $sliders->lastPage() ? 'disabled' : '' }}">
                <a href="#" class="page-link text-dark" wire:click.prevent="nextPage">
                    Next
                </a>
            </li>
        </ul>
    </nav>
</div>

{{-- SortableJS --}}
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('livewire:init', function() {
            initSortable();

            Livewire.on('reorderComplete', function() {
                setTimeout(initSortable, 100);
            });
        });

        function initSortable() {
            const el = document.getElementById('sortable-sliders');
            if (!el) return;

            new Sortable(el, {
                animation: 150,
                handle: '.drag-handle',
                ghostClass: 'bg-light',
                dragClass: 'opacity-75',
                onEnd: function(evt) {
                    const order = [];
                    el.querySelectorAll('tr[data-id]').forEach((row, index) => {
                        order.push({
                            id: row.dataset.id,
                            order: index + 1
                        });
                    });
                    Livewire.dispatch('updateOrder', {
                        order: order
                    });
                }
            });
        }
    </script>
@endpush
