<div>
    @if (session()->has('success'))
        <div class="alert alert-success" style="position:fixed;bottom:20px;right:40px;z-index:9999;">
            {{ session('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-end align-items-center mb-3 gap-2">
        <input type="search" class="form-control form-control-sm rounded table-search" placeholder="Search ..."
            wire:model.debounce.500ms="search" wire:change="applyFilters">
        <button class="btn btn-dark py-2 px-2 fs-20" wire:click="toggleFilter" type="button">
            <i class="lni lni-funnel-1"></i>
        </button>
    </div>
    @if (!empty($selectedPopups))
        <div class="mb-3">
            <button class="btn btn-danger btn-sm" wire:click="deleteSelected" wire:confirm="Delete selected popups?">
                Delete Selected ({{ count($selectedPopups) }})
            </button>
        </div>
    @endif
    <div class="list-table-container">
        <table class="table">
            <thead>
                <tr>
                    <th style="width:50px;">
                        <input class="form-check-input" type="checkbox"
                            wire:click="toggleSelectAll($event.target.checked)">
                    </th>
                    <th style="width:46px;"></th>
                    <th class="highlight-text">Title</th>
                    <th class="highlight-text">Short Description</th>
                    <th class="highlight-text">Linked To</th>
                    <th class="highlight-text">Order</th>
                    <th class="highlight-text">Status</th>
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
                                <img src="{{ $popup->thumbnail_url }}" alt="{{ $popup->title }}" class="avatar me-3">
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.popups.edit', $popup->id) }}" class="user-name mb-0">
                                {{ $popup->title }}
                            </a>
                        </td>
                        <td>
                            {{ Str::limit($popup->short_description, 60) }}
                        </td>
                        <td>
                            @if ($popup->resource_type)
                                <span class="badge bg-secondary">
                                    {{ ucfirst($popup->resource_type) }}
                                    #{{ $popup->resource_id }}
                                </span>
                            @else
                                <span class="text-muted">Manual</span>
                            @endif
                        </td>
                        <td>{{ $popup->display_order }}</td>
                        <td>
                            <span class="status-badge">
                                {{ $popup->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="position-absolute end-0 top-0 edit-button-td">
                            <a href="{{ route('admin.popups.edit', $popup->id) }}"
                                class="btn btn-sm btn-link text-white p-0
                                       text-decoration-none edit-button fs-24">
                                <i class="lni lni-pen-to-square"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            No popups found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <nav class="pagination mt-3 mb-2 d-flex justify-content-end align-items-center">
        <select class="form-select form-select-sm me-2 rounded mt-0 py-2" style="width:auto;" wire:model="perPage"
            wire:change="applyFilters">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
        <ul class="pagination pb-0 mb-0">
            <li class="page-item {{ $popups->onFirstPage() ? 'disabled' : '' }}">
                <a href="#" class="page-link text-dark" wire:click.prevent="previousPage">Previous</a>
            </li>
            @for ($p = 1; $p <= $popups->lastPage(); $p++)
                <li class="page-item
                    {{ $popups->currentPage() == $p ? 'active' : '' }}">
                    <a href="#"
                        class="page-link
                        {{ $popups->currentPage() == $p ? 'bg-dark text-white border-dark' : 'text-dark' }}"
                        wire:click.prevent="gotoPage({{ $p }})">
                        {{ $p }}
                    </a>
                </li>
            @endfor
            <li class="page-item
{{ $popups->currentPage() == $popups->lastPage() ? 'disabled' : '' }}">
                <a href="#" class="page-link text-dark" wire:click.prevent="nextPage">Next</a>
            </li>
        </ul>
    </nav>
</div>
