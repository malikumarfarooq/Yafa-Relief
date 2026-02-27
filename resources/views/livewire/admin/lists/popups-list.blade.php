<div>
    {{-- Success toast --}}
    @if (session()->has('success'))
        <div class="alert alert-success mt-3 d-flex justify-content-between align-items-center gap-3"
            style="position:fixed; bottom:0; right:40px; z-index:9999;">
            <span class="pe-5">{{ session('success') }}</span>
            <span style="font-size:48px" class="position-absolute top-50 start-100 translate-middle">😎</span>
        </div>
    @endif

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0" style="font-size:18px; font-weight:600;">All Popups</h5>
        <a href="{{ route('admin.popups.create') }}" class="btn btn-dark btn-sm px-3 py-2"
            style="font-size:13px; font-weight:500;">
            + Create New Popup
        </a>
    </div>

    {{-- Search --}}
    <div class="d-flex justify-content-end align-items-center mb-3 gap-2">
        <input type="search" class="form-control form-control-sm rounded" placeholder="Search by title..."
            wire:model.debounce.500ms="search" wire:change="applyFilters" style="max-width:240px;">
    </div>

    {{-- Bulk delete --}}
    @if (!empty($selectedPopups))
        <div class="mb-3">
            <button class="btn btn-danger btn-sm" wire:click="deleteSelected" wire:confirm="Delete selected popups?">
                Delete Selected ({{ count($selectedPopups) }})
            </button>
        </div>
    @endif

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th style="width:40px;">
                        <input class="form-check-input" type="checkbox"
                            wire:click="toggleSelectAll($event.target.checked)"
                            {{ count($popups) == 0 ? 'disabled' : '' }}>
                    </th>
                    <th style="width:50px;">Image</th>
                    <th>Title</th>
                    <th>Short Description</th>
                    <th>Linked To</th>
                    <th>Order</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($popups as $popup)
                    <tr>
                        <td>
                            <input class="form-check-input" type="checkbox" wire:model="selectedPopups"
                                value="{{ $popup->id }}">
                        </td>
                        <td>
                            <img src="{{ $popup->thumbnail_url }}" alt="{{ $popup->title }}"
                                style="width:42px; height:42px; object-fit:cover; border-radius:8px;">
                        </td>
                        <td style="font-size:14px; font-weight:500;">
                            {{ $popup->title }}
                        </td>
                        <td style="font-size:13px; color:#6c757d;">
                            {{ \Illuminate\Support\Str::limit($popup->short_description, 60) }}
                        </td>
                        <td style="font-size:13px;">
                            @if ($popup->resource_type)
                                <span class="badge bg-secondary">
                                    {{ ucfirst($popup->resource_type) }} #{{ $popup->resource_id }}
                                </span>
                            @else
                                <span class="text-muted">Manual</span>
                            @endif
                        </td>
                        <td style="font-size:13px;">{{ $popup->display_order }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox"
                                    {{ $popup->is_active ? 'checked' : '' }}
                                    wire:click="toggleActive({{ $popup->id }})" style="cursor:pointer;">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.popups.edit', $popup->id) }}"
                                    class="btn btn-sm btn-outline-dark">
                                    Edit
                                </a>
                                <button class="btn btn-sm btn-outline-danger" wire:click="delete({{ $popup->id }})"
                                    wire:confirm="Delete this popup?">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">No popups found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
            <select class="form-select form-select-sm" style="width:auto;" wire:model="perPage"
                wire:change="applyFilters">
                <option value="5">5 per page</option>
                <option value="10">10 per page</option>
                <option value="25">25 per page</option>
                <option value="50">50 per page</option>
            </select>
        </div>
        <ul class="pagination pagination-sm mb-0">
            <li class="page-item {{ $popups->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link text-dark" wire:click.prevent="goToPage({{ $popups->currentPage() - 1 }})"
                    href="#">Previous</a>
            </li>
            @foreach (range(1, $popups->lastPage()) as $p)
                <li class="page-item {{ $popups->currentPage() == $p ? 'active' : '' }}">
                    <a class="page-link {{ $popups->currentPage() == $p ? 'bg-dark text-white border-dark' : 'text-dark' }}"
                        wire:click.prevent="goToPage({{ $p }})" href="#">{{ $p }}</a>
                </li>
            @endforeach
            <li class="page-item {{ $popups->currentPage() == $popups->lastPage() ? 'disabled' : '' }}">
                <a class="page-link text-dark" wire:click.prevent="goToPage({{ $popups->currentPage() + 1 }})"
                    href="#">Next</a>
            </li>
        </ul>
    </div>
</div>
