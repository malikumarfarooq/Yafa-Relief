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

            <!-- Name/Email Search -->
            <div class="form-group col-md-3">
                <label class="form-label fw-500 mb-1">Page Title</label>
                <input type="text" class="form-control form-control-sm rounded mt-1 p-2"
                    placeholder="Search by category name" wire:model.debounce.500ms="search">
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
                    <th class="highlight-text">Title</th>
                    <th class="highlight-text">Description</th>
                    <th class="highlight-text">Featured</th>
                    <th class="highlight-text">Active</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pages as $page)
                <tr class="position-relative">
                    <td>
                        <input class="form-check-input" type="checkbox" wire:model="selectedPages"
                            value="{{ $page->id }}">
                    </td>
                    <td>
                        <a href="/admin/content/pages/{{ $page->id }}/edit">
                            <img src="{{ $page->thumbnail
                                    ? asset('storage/'.$page->thumbnail)
                                    : asset('/admin-assets/images/image.png') }}" class="avatar" alt="Avatar">
                        </a>
                    </td>

                    <td>
                        <a href="/admin/content/pages/{{ $page->id }}/edit">
                            {{ $page->title }}
                        </a>
                    </td>

                    <td>{{ Str::limit($page->short_description, 60) }}</td>
                    <td>{{ $page->is_featured ? 'Yes' : 'No'}}</td>
                    <td>{{ $page->is_active ? 'Yes' : 'No'}}</td>

                    <td class="position-absolute end-0 top-0 edit-button-td">
                        <a href="/admin/content/pages/{{ $page->id }}/edit"
                            class="btn btn-sm btn-link text-white p-0 text-decoration-none edit-button fs-24">
                            <i class="lni lni-pen-to-square"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-3">No pages found.</td>
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
            <li class="page-item {{ $pages->onFirstPage() ? 'disabled' : '' }}">
                <a href="#" class="page-link text-dark"
                    wire:click.prevent="goToPage({{ $pages->currentPage() - 1 }})">Previous</a>
            </li>

            <!-- Page Numbers -->
            @foreach(range(1, $pages->lastPage()) as $p)
            <li class="page-item {{ $pages->currentPage() == $p ? 'active' : '' }}">
                <a href="#"
                    class="page-link {{ $pages->currentPage() == $p ? 'bg-dark text-white border-dark' : 'text-dark' }}"
                    wire:click.prevent="goToPage({{ $p }})">{{ $p }}</a>
            </li>
            @endforeach

            <!-- Next -->
            <li
                class="page-item {{ $pages->currentPage() == $pages->lastPage() ? 'disabled' : '' }}">
                <a href="#" class="page-link text-dark"
                    wire:click.prevent="goToPage({{ $pages->currentPage() + 1 }})">Next</a>
            </li>
        </ul>
    </nav>

</div>