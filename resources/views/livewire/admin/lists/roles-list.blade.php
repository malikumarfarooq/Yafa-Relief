<div>
    <!-- Search and Filter Button -->
    <div class="d-flex justify-content-end align-items-center mb-3 gap-2">
        <input type="search" class="form-control form-control-sm rounded table-search"
            placeholder="Search ..." wire:model.debounce.500ms="search" wire:change="applyFilters">

        <button class="btn btn-dark py-2 px-2 fs-20" wire:click="toggleFilter" type="button">
            <i class="lni lni-funnel-1"></i>
        </button>
    </div>

    <!-- Filter Section -->
    <form class="filter-section mb-3 px-3 py-2 border position-relative bg-light {{ $filter ? '' : 'd-none' }}"
        wire:submit.prevent>
        <div class="row table-filters-row">

            <!-- role name -->
            <div class="form-group col-md-3">
                <label class="form-label fw-500 mb-1">Role Name</label>
                <input type="text" class="form-control form-control-sm rounded mt-1 p-2"
                    placeholder="Search by role name" wire:model.debounce.500ms="search">
            </div>
        </div>

        <!-- Reset / Filter Buttons -->
        <button type="button" wire:click="resetFilters"
            class="filter-reset-button btn btn-secondary position-absolute end-0 top-0 py-2">Reset</button>
        <button type="button" class="filter-action-button btn btn-dark py-2 position-absolute bottom-0 end-0"
            wire:click="applyFilters">Filter</button>
    </form>

    <!-- Users Table -->
    <div class="list-table-container">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 50px;">
                        <input class="form-check-input" type="checkbox"
                            wire:click="toggleSelectAll($event.target.checked)">
                    </th>
                    <th class="highlight-text">Role</th>
                    <th class="highlight-text">Description</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                <tr class="position-relative">
                    <td>
                        <input class="form-check-input" type="checkbox" wire:model="selectedRoles"
                            value="{{ $role->id }}">
                    </td>
                    
                    <td>
                        <a href="/admin/settings/roles/{{ $role->id }}/edit" class="user-name mb-0">
                            {{ ucfirst($role->name) }}
                        </a>
                    </td>
                    <td>{{ $role->description ?? '-' }}</td>
                    <td class="position-absolute end-0 top-0 edit-button-td">
                        <a href="/admin/settings/roles/{{ $role->id }}/edit"
                            class="btn btn-sm btn-link text-white p-0 text-decoration-none edit-button fs-24">
                            <i class="lni lni-pen-to-square"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-3">No roles found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination and Per Page -->
    <nav aria-label="..." class="pagination mt-3 mb-2 d-flex justify-content-end align-items-center">

        <!-- Per Page -->
        <select class="form-select form-select-sm me-2 rounded mt-0 py-2" style="width: auto;" wire:model="perPage" wire:change="applyFilters">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>

        <!-- Pagination -->
        <ul class="pagination pb-0 mb-0">
            <!-- Previous -->
            <li class="page-item {{ $roles->onFirstPage() ? 'disabled' : '' }}">
                <a href="#" class="page-link text-dark"
                    wire:click.prevent="goToPage({{ $roles->currentPage() - 1 }})">Previous</a>
            </li>

            <!-- Page Numbers -->
            @foreach(range(1, $roles->lastPage()) as $p)
            <li class="page-item {{ $roles->currentPage() == $p ? 'active' : '' }}">
                <a href="#"
                    class="page-link {{ $roles->currentPage() == $p ? 'bg-dark text-white border-dark' : 'text-dark' }}"
                    wire:click.prevent="goToPage({{ $p }})">{{ $p }}</a>
            </li>
            @endforeach

            <!-- Next -->
            <li class="page-item {{ $roles->currentPage() == $roles->lastPage() ? 'disabled' : '' }}">
                <a href="#" class="page-link text-dark"
                    wire:click.prevent="goToPage({{ $roles->currentPage() + 1 }})">Next</a>
            </li>
        </ul>
    </nav>
    @if (session()->has('success'))
    <div class="alert alert-success mt-3 d-flex justify-content-between align-items-center gap-3"
        style="position: fixed; bottom: 0px; right: 40px; z-index: 9999;">
        <span class="pe-5">{{ session('success') }}</span> <span style="font-size: 48px"
            class="position-absolute top-50 start-100 translate-middle">😎</span>
    </div>
    @endif
    @if (session()->has('error'))
    <div class="alert alert-danger mt-3 d-flex justify-content-between align-items-center gap-3"
        style="position: fixed; bottom: 0px; right: 40px; z-index: 9999;">
        <span class="pe-5">{{ session('error') }}</span> <span style="font-size: 48px"
            class="position-absolute top-50 start-100 translate-middle">😟</span>
    </div>
    @endif
</div>