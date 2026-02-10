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

            <!-- Name/Email Search -->
            <div class="form-group col-md-3">
                <label class="form-label fw-500 mb-1">Program Name</label>
                <input type="text" class="form-control form-control-sm rounded mt-1 p-2"
                    placeholder="Search by program name" wire:model.debounce.500ms="search">
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
                    <th style="width: 46px;"></th>
                    <th class="highlight-text">Program Title</th>
                    <th class="highlight-text">Goal Amount</th>
                    <th class="highlight-text">Urgent</th>
                    <th class="highlight-text">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($programs as $program)
                <tr class="position-relative">
                    <td>
                        <input class="form-check-input" type="checkbox" wire:model="selectedPrograms"
                            value="{{ $program->id }}">
                    </td>
                    <td>
                        <a href="/admin/programs/{{ $program->id }}/edit">
                            <img src="{{ asset('storage/'.$program->thumbnail) ?? '/admin-assets/images/image.png' }}" alt="Avatar" class="avatar me-3">
                        </a>
                    </td>
                    <td>
                        <a href="/admin/programs/{{ $program->id }}/edit" class="user-name mb-0">
                            {{ $program->title }}
                        </a>
                    </td>
                    <td>{{ $program->goal_amount }}</td>
                    <td>{{ $program->urgent ? 'Yes' : 'No' }}</td>
                    <td><span class="status-badge">{{ $program->is_active ? 'Active' : 'Inactive' }}</span></td>
                    <td class="position-absolute end-0 top-0 edit-button-td">
                        <a href="/admin/programs/{{ $program->id }}/edit"
                            class="btn btn-sm btn-link text-white p-0 text-decoration-none edit-button fs-24">
                            <i class="lni lni-pen-to-square"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-3">No programs found.</td>
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
            <li class="page-item {{ $programs->onFirstPage() ? 'disabled' : '' }}">
                <a href="#" class="page-link text-dark"
                    wire:click.prevent="goToPage({{ $programs->currentPage() - 1 }})">Previous</a>
            </li>

            <!-- Page Numbers -->
            @foreach(range(1, $programs->lastPage()) as $p)
            <li class="page-item {{ $programs->currentPage() == $p ? 'active' : '' }}">
                <a href="#"
                    class="page-link {{ $programs->currentPage() == $p ? 'bg-dark text-white border-dark' : 'text-dark' }}"
                    wire:click.prevent="goToPage({{ $p }})">{{ $p }}</a>
            </li>
            @endforeach

            <!-- Next -->
            <li class="page-item {{ $programs->currentPage() == $programs->lastPage() ? 'disabled' : '' }}">
                <a href="#" class="page-link text-dark"
                    wire:click.prevent="goToPage({{ $programs->currentPage() + 1 }})">Next</a>
            </li>
        </ul>
    </nav>

</div>