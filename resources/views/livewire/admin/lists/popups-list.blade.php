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
    {{-- <div class="col-md-9"> --}}
    <div class="col-md-10">
        <div class="card border-0 shadow-sm rounded-3 p-4">

            {{-- Success Alert --}}
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Header + Create Button --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0" style="font-size: 18px; font-weight: 600;">All Popups</h5>
                <a href="{{ route('admin.popups.create') }}" class="btn btn-dark btn-sm px-3 py-2"
                    style="font-size: 13px; font-weight: 500;">
                    + Create New Popup
                </a>
            </div>

            {{-- Search and Filter --}}
            <div class="d-flex justify-content-end align-items-center mb-3 gap-2">
                <input type="search" class="form-control form-control-sm rounded table-search" placeholder="Search ..."
                    wire:model.debounce.500ms="search" wire:change="applyFilters" style="max-width: 240px;">
                <button class="btn btn-dark py-2 px-2 fs-20" wire:click="toggleFilter" type="button">
                    <i class="lni lni-funnel-1"></i>
                </button>
            </div>

            {{-- Filter Section --}}
            <form
                class="filter-section mb-3 px-3 py-3 border rounded position-relative bg-light {{ $filter ? '' : 'd-none' }}"
                wire:submit.prevent>
                <div class="row table-filters-row">
                    <div class="form-group col-md-3">
                        <label class="form-label mb-1" style="font-size: 13px; font-weight: 500;">Popup Title</label>
                        <input type="text" class="form-control form-control-sm rounded p-2"
                            placeholder="Search by popup title" wire:model.debounce.500ms="search">
                    </div>
                </div>
                <button type="button" wire:click="resetFilters"
                    class="filter-reset-button btn btn-secondary position-absolute end-0 top-0 py-2">Reset</button>
                <button type="button" wire:click="applyFilters"
                    class="filter-action-button btn btn-dark py-2 position-absolute bottom-0 end-0">Filter</button>
            </form>

            {{-- Bulk Delete --}}
            @if (!empty($selectedPopups))
                <div class="mb-3">
                    <button class="btn btn-danger btn-sm" wire:click="deleteSelected"
                        wire:confirm="Delete selected popups?">
                        Delete Selected ({{ count($selectedPopups) }})
                    </button>
                </div>
            @endif

            {{-- Table --}}
            <div class="list-table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">
                                <input class="form-check-input" type="checkbox"
                                    wire:click="toggleSelectAll($event.target.checked)"
                                    {{ count($popups) == 0 ? 'disabled' : '' }}>
                            </th>
                            <th style="width: 46px;"></th>
                            <th class="highlight-text">Title</th>
                            <th class="highlight-text">Description</th>
                            <th class="highlight-text">Button Text</th>
                            <th class="highlight-text">Order</th>
                            <th class="highlight-text">Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($popups as $popup)
                            <tr class="position-relative">
                                <td>
                                    <input class="form-check-input" type="checkbox" wire:model="selectedPopups"
                                        value="{{ $popup->id }}">
                                </td>
                                <td>
                                    <a href="{{ route('admin.popups.edit', $popup->id) }}">
                                        <img src="{{ $popup->thumbnail
                                            ? asset('storage/' . $popup->thumbnail)
                                            : ($popup->cover_image
                                                ? asset('storage/' . $popup->cover_image)
                                                : asset('admin-assets/images/image.png')) }}"
                                            class="avatar" alt="{{ $popup->title }}">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.popups.edit', $popup->id) }}"
                                        class="text-decoration-none text-dark" style="font-size: 14px;">
                                        {{ $popup->title }}
                                    </a>
                                </td>
                                <td style="font-size: 13px; color: #6c757d;">
                                    {{ Str::limit($popup->short_description ?? '', 60) }}
                                </td>
                                <td style="font-size: 13px;">{{ $popup->button_text ?? '—' }}</td>
                                <td style="font-size: 13px;">{{ $popup->display_order ?? '—' }}</td>
                                <td style="font-size: 13px;">{{ $popup->is_active ? 'Yes' : 'No' }}</td>
                                <td class="position-absolute end-0 top-0 edit-button-td">
                                    <a href="{{ route('admin.popups.edit', $popup->id) }}"
                                        class="btn btn-sm btn-link text-white p-0 text-decoration-none edit-button fs-24">
                                        <i class="lni lni-pen-to-square"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted" style="font-size: 14px;">
                                    No popups found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <nav aria-label="..." class="pagination mt-3 mb-0 d-flex justify-content-end align-items-center">
                <select class="form-select form-select-sm me-2 rounded mt-0 py-2" style="width: auto; font-size: 13px;"
                    wire:model="perPage" wire:change="applyFilters">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>

                <ul class="pagination pb-0 mb-0">
                    <li class="page-item {{ $popups->onFirstPage() ? 'disabled' : '' }}">
                        <a href="#" class="page-link text-dark"
                            wire:click.prevent="goToPage({{ $popups->currentPage() - 1 }})">Previous</a>
                    </li>
                    @foreach (range(1, $popups->lastPage()) as $p)
                        <li class="page-item {{ $popups->currentPage() == $p ? 'active' : '' }}">
                            <a href="#"
                                class="page-link {{ $popups->currentPage() == $p ? 'bg-dark text-white border-dark' : 'text-dark' }}"
                                wire:click.prevent="goToPage({{ $p }})">{{ $p }}</a>
                        </li>
                    @endforeach
                    <li class="page-item {{ $popups->currentPage() == $popups->lastPage() ? 'disabled' : '' }}">
                        <a href="#" class="page-link text-dark"
                            wire:click.prevent="goToPage({{ $popups->currentPage() + 1 }})">Next</a>
                    </li>
                </ul>
            </nav>

        </div>{{-- /card --}}
    </div>{{-- /col-md-9 --}}

</div>{{-- /row --}}
