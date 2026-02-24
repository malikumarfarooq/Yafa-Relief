<div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Search and Filter --}}
    <div class="d-flex justify-content-end align-items-center mb-3 gap-2">
        <input type="search" class="form-control form-control-sm rounded table-search" placeholder="Search ..."
            wire:model.live.debounce.500ms="search">
        <button class="btn btn-dark py-2 px-2 fs-20" wire:click="toggleFilter" type="button">
            <i class="lni lni-funnel-1"></i>
        </button>
    </div>

    {{-- Filter Section --}}
    <div class="filter-section mb-3 px-3 py-2 border position-relative bg-light {{ $filter ? '' : 'd-none' }}">
        <div class="row table-filters-row">
            <div class="form-group col-md-3">
                <label class="form-label fw-500 mb-1">Slide Title</label>
                <input type="text" class="form-control form-control-sm rounded mt-1 p-2"
                    placeholder="Search by title" wire:model.live.debounce.500ms="search">
            </div>
        </div>
        <button type="button" wire:click="resetFilters"
            class="filter-reset-button btn btn-secondary position-absolute end-0 top-0 py-2">
            Reset
        </button>
        <button type="button" wire:click="applyFilters"
            class="filter-action-button btn btn-dark py-2 position-absolute bottom-0 end-0">
            Filter
        </button>
    </div>

    {{-- Drag and Drop Notice --}}
    <div class="alert alert-info py-2 mb-3">
        <small><i class="lni lni-move"></i> Drag and drop rows to reorder slides</small>
    </div>

    {{-- Table --}}
    <div class="list-table-container">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 30px;"></th>
                    <th style="width: 50px;">
                        <input class="form-check-input" type="checkbox"
                            wire:click="toggleSelectAll($event.target.checked)">
                    </th>
                    <th style="width: 46px;"></th>
                    <th class="highlight-text">Title</th>
                    <th class="highlight-text">Type</th>
                    <th class="highlight-text">Order</th>
                    <th class="highlight-text">Status</th>
                    <th class="highlight-text">Actions</th>
                </tr>
            </thead>
            <tbody id="sortable-sliders">
                @forelse($sliders as $slider)
                    <tr wire:key="slider-{{ $slider->id }}" data-id="{{ $slider->id }}">
                        {{-- Drag Handle --}}
                        <td style="cursor: grab;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#999"
                                viewBox="0 0 16 16">
                                <path
                                    d="M7 2a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7 5a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-3 3a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-3 3a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                            </svg>
                        </td>
                        <td>
                            <input class="form-check-input" type="checkbox" wire:model="selectedSliders"
                                value="{{ $slider->id }}">
                        </td>
                        <td>
                            <a href="/admin/hero-sliders/{{ $slider->id }}/edit">
                                @if ($slider->media_type === 'image')
                                    <img src="{{ asset('storage/' . $slider->media_path) }}" class="avatar"
                                        alt="Slide">
                                @else
                                    <img src="/admin-assets/images/image.png" class="avatar" alt="Video">
                                @endif
                            </a>
                        </td>
                        <td>
                            <a href="/admin/hero-sliders/{{ $slider->id }}/edit">
                                {{ $slider->title }}
                            </a>
                        </td>
                        <td>{{ ucfirst($slider->media_type) }}</td>
                        <td>{{ $slider->order }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox"
                                    wire:click="toggleStatus({{ $slider->id }})"
                                    {{ $slider->status === 'active' ? 'checked' : '' }}
                                    style="cursor: pointer; width: 50px; height: 25px;">
                            </div>
                        </td>
                        <td class="d-flex gap-2 align-items-center">
                            <a href="/admin/hero-sliders/{{ $slider->id }}/edit" class="btn btn-sm btn-light border">
                                <i class="lni lni-pen-to-square"></i>
                            </a>
                            <button wire:click="delete({{ $slider->id }})"
                                wire:confirm="Are you sure you want to delete this slide?"
                                class="btn btn-sm btn-light border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                    <path
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-3">No slides found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <nav class="pagination mt-3 mb-2 d-flex justify-content-end align-items-center">
        <select class="form-select form-select-sm me-2 rounded mt-0 py-2" style="width: auto;"
            wire:model.live="perPage">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
        <ul class="pagination pb-0 mb-0">
            <li class="page-item {{ $sliders->onFirstPage() ? 'disabled' : '' }}">
                <a href="#" class="page-link text-dark"
                    wire:click.prevent="goToPage({{ $sliders->currentPage() - 1 }})">
                    Previous
                </a>
            </li>
            @foreach (range(1, $sliders->lastPage()) as $p)
                <li class="page-item {{ $sliders->currentPage() == $p ? 'active' : '' }}">
                    <a href="#"
                        class="page-link {{ $sliders->currentPage() == $p ? 'bg-dark text-white border-dark' : 'text-dark' }}"
                        wire:click.prevent="goToPage({{ $p }})">
                        {{ $p }}
                    </a>
                </li>
            @endforeach
            <li class="page-item {{ $sliders->currentPage() == $sliders->lastPage() ? 'disabled' : '' }}">
                <a href="#" class="page-link text-dark"
                    wire:click.prevent="goToPage({{ $sliders->currentPage() + 1 }})">
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
        document.addEventListener('livewire:navigated', initSortable);
        document.addEventListener('DOMContentLoaded', initSortable);

        function initSortable() {
            const el = document.getElementById('sortable-sliders');
            if (!el) return;

            Sortable.create(el, {
                animation: 150,
                handle: 'td:first-child',
                ghostClass: 'bg-light',
                onEnd: function(evt) {
                    const rows = el.querySelectorAll('tr[data-id]');
                    const order = [];
                    rows.forEach((row, index) => {
                        order.push({
                            value: row.dataset.id,
                            order: index + 1
                        });
                    });
                    @this.call('updateOrder', order);
                }
            });
        }
    </script>
@endpush
