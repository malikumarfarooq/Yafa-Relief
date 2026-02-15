<div>
    <!-- Search and Filter Button -->
    <div class="d-flex justify-content-end align-items-center mb-3 gap-2">
        <input type="search" class="form-control form-control-sm rounded table-search" placeholder="Search ..."
            wire:model.debounce.500ms="search" wire:change="applyFilters">

        <button class="btn btn-dark py-2 px-2 fs-20" wire:click="toggleFilter" type="button">
            <i class="lni lni-funnel-1"></i>
        </button>
    </div>

    <!-- Filter Section -->
    <form class="filter-section mb-3 px-3 py-2 border position-relative bg-light {{ $filter ? '' : 'd-none' }}"
        wire:submit.prevent>
        <div class="row table-filters-row">
            <div class="form-group col-md-3">
                <label class="form-label fw-500 mb-1">Donor Email</label>
                <input type="text" class="form-control form-control-sm rounded mt-1 p-2"
                    placeholder="Search with Donor Email" wire:model.debounce.500ms="search">
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
                    <th class="highlight-text">Email</th>
                    <th class="highlight-text">Total Donations</th>
                    <th class="highlight-text">Total Donation Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($donors as $donor)
                <tr>
                    <td>
                        <input class="form-check-input" type="checkbox" wire:model="selectedDonors"
                            value="{{ $donor->email }}">
                    </td>

                    <td>
                        <a href="/admin/donations/donors/show/{{ $donor->email }}" class="user-name mb-0">
                            {{ $donor->email }}
                        </a>
                        
                    </td>

                    <td>
                        {{ $donor->total_donations }}
                    </td>

                    <td>
                        ${{ number_format($donor->total_donation_amount, 2) }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-3">
                        No Donors found.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <!-- Pagination and Per Page -->
    <nav aria-label="..." class="pagination mt-3 mb-2 d-flex justify-content-end align-items-center">

        <!-- Per Page -->
        <select class="form-select form-select-sm me-2 rounded mt-0 py-2" style="width: auto;" wire:model="perPage"
            wire:change="applyFilters">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>

        <!-- Pagination -->
        <ul class="pagination pb-0 mb-0">

            <!-- Previous -->
            <li class="page-item {{ $donors->onFirstPage() ? 'disabled' : '' }}">
                <a href="#" class="page-link text-dark" wire:click.prevent="previousPage">
                    Previous
                </a>
            </li>

            <!-- Page Numbers -->
            @for ($p = 1; $p <= $donors->lastPage(); $p++)
                <li class="page-item {{ $donors->currentPage() == $p ? 'active' : '' }}">
                    <a href="#"
                        class="page-link {{ $donors->currentPage() == $p ? 'bg-dark text-white border-dark' : 'text-dark' }}"
                        wire:click.prevent="gotoPage({{ $p }})">
                        {{ $p }}
                    </a>
                </li>
                @endfor

                <!-- Next -->
                <li class="page-item {{ $donors->currentPage() == $donors->lastPage() ? 'disabled' : '' }}">
                    <a href="#" class="page-link text-dark" wire:click.prevent="nextPage">
                        Next
                    </a>
                </li>

        </ul>

    </nav>

</div>