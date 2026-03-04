<div>
    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Search and Filter Button -->
    <div class="d-flex justify-content-end align-items-center mb-3 gap-2">
        <input type="search" class="form-control form-control-sm rounded table-search" placeholder="Search email..."
            wire:model.live.debounce.300ms="search">

        <button class="btn btn-dark py-2 px-2 fs-20" wire:click="toggleFilter" type="button">
            <i class="lni lni-funnel-1"></i>
        </button>

        <a href="{{ route('admin.settings.newsletters.export') }}"
            class="btn btn-success btn-sm d-flex align-items-center gap-2">
            <i class="lni lni-download"></i> Export CSV
        </a>
    </div>

    <!-- Filter Section -->
    @if ($filter)
        <form class="filter-section mb-3 px-3 py-2 border position-relative bg-light" wire:submit.prevent>
            <div class="row table-filters-row">
                <!-- Status Filter -->
                <div class="form-group col-md-4">
                    <label class="form-label fw-500 mb-1">Status</label>
                    <select class="form-select form-select-sm" wire:model.live="status">
                        <option value="">All Status</option>
                        <option value="subscribed">Subscribed</option>
                        <option value="unsubscribed">Unsubscribed</option>
                    </select>
                </div>
            </div>

            <!-- Reset Button -->
            <button type="button" wire:click="clearFilters"
                class="filter-reset-button btn btn-secondary position-absolute end-0 top-0 py-2">Reset</button>
            <button type="button" class="filter-action-button btn btn-dark py-2 position-absolute bottom-0 end-0"
                wire:click="applyFilters">Filter</button>
        </form>
    @endif

    <!-- Subscribers Table -->
    <div class="list-table-container">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 50px;">
                        <input class="form-check-input" type="checkbox"
                            wire:click="toggleSelectAll($event.target.checked)">
                    </th>
                    <th style="width: 46px;">#</th>
                    <th class="highlight-text">Email</th>
                    <th class="highlight-text">Status</th>
                    <th class="highlight-text">Subscribed At</th>
                    <th class="highlight-text">Unsubscribed At</th>
                    <th class="highlight-text">Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subscribers as $subscriber)
                    <tr class="position-relative" wire:key="subscriber-{{ $subscriber->id }}">
                        <td>
                            <input class="form-check-input" type="checkbox" wire:model="selectedSubscribers"
                                value="{{ $subscriber->id }}">
                        </td>
                        <td>
                            <span class="fw-500">{{ $loop->iteration }}</span>
                        </td>
                        <td>
                            <a href="mailto:{{ $subscriber->email }}" class="user-name mb-0">
                                {{ $subscriber->email }}
                            </a>
                        </td>
                        <td>
                            <span
                                class="badge rounded-pill px-3 py-2
                            {{ $subscriber->status === 'subscribed' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($subscriber->status) }}
                            </span>
                        </td>
                        <td>{{ $subscriber->subscribed_at?->format('d M Y H:i') ?? '—' }}</td>
                        <td>{{ $subscriber->unsubscribed_at?->format('d M Y H:i') ?? '—' }}</td>
                        <td>{{ $subscriber->created_at->format('d M Y') }}</td>
                        <td class="position-absolute end-0 top-0 edit-button-td">
                            <!-- Optional: Add action buttons if needed -->
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="lni lni-envelope fs-1 d-block mb-3 opacity-50"></i>
                            No subscribers yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination and Per Page -->
    <nav aria-label="..." class="pagination mt-3 mb-2 d-flex justify-content-end align-items-center">

        <!-- Per Page -->
        <select class="form-select form-select-sm me-2 rounded mt-0 py-2" style="width: auto;"
            wire:model.live="perPage">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>

        <!-- Pagination -->
        <ul class="pagination pb-0 mb-0">
            <!-- Previous -->
            <li class="page-item {{ $subscribers->onFirstPage() ? 'disabled' : '' }}">
                <a href="#" class="page-link text-dark" wire:click.prevent="previousPage">
                    Previous
                </a>
            </li>

            <!-- Page Numbers -->
            @for ($p = 1; $p <= $subscribers->lastPage(); $p++)
                <li class="page-item {{ $subscribers->currentPage() == $p ? 'active' : '' }}">
                    <a href="#"
                        class="page-link {{ $subscribers->currentPage() == $p ? 'bg-dark text-white border-dark' : 'text-dark' }}"
                        wire:click.prevent="gotoPage({{ $p }})">
                        {{ $p }}
                    </a>
                </li>
            @endfor

            <!-- Next -->
            <li class="page-item {{ $subscribers->currentPage() == $subscribers->lastPage() ? 'disabled' : '' }}">
                <a href="#" class="page-link text-dark" wire:click.prevent="nextPage">
                    Next
                </a>
            </li>
        </ul>
    </nav>
</div>
