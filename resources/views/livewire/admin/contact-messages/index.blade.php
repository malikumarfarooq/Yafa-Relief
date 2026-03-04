<div>

    <!-- Search and Filter Button -->
    <div class="d-flex justify-content-end align-items-center mb-3 gap-2">
        <input type="search" class="form-control form-control-sm rounded table-search"
            placeholder="Search name, email or subject..." wire:model.live.debounce.300ms="search">

        <button class="btn btn-dark py-2 px-2 fs-20" wire:click="toggleFilter" type="button">
            <i class="lni lni-funnel-1"></i>
        </button>

        <a href="{{ route('admin.contact-messages.export') }}"
            class="btn btn-success btn-sm d-flex align-items-center gap-2">
            <i class="lni lni-download"></i> Export
        </a>
    </div>

    <!-- Filter Section -->
    <form class="filter-section mb-3 px-3 py-2 border position-relative bg-light {{ $filter ? '' : 'd-none' }}"
        wire:submit.prevent>
        <div class="row table-filters-row">
            <!-- Status Filter -->
            <div class="form-group col-md-3">
                <label class="form-label fw-500 mb-1">Status</label>
                <select class="form-select form-select-sm" wire:model.live="status">
                    <option value="">All Status</option>
                    <option value="new">New</option>
                    <option value="replied">Replied</option>
                    <option value="closed">Closed</option>
                </select>
            </div>

            <!-- Date Filter -->
            <div class="form-group col-md-3">
                <label class="form-label fw-500 mb-1">Date</label>
                <input type="date" class="form-control form-control-sm" wire:model.live="date">
            </div>
        </div>

        <!-- Reset / Filter Buttons -->
        <button type="button" wire:click="clearFilters"
            class="filter-reset-button btn btn-secondary position-absolute end-0 top-0 py-2">Reset</button>
        <button type="button" class="filter-action-button btn btn-dark py-2 position-absolute bottom-0 end-0"
            wire:click="applyFilters">Filter</button>
    </form>

    <!-- Messages Table -->
    <div class="list-table-container">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 50px;">
                        <input class="form-check-input" type="checkbox"
                            wire:click="toggleSelectAll($event.target.checked)">
                    </th>
                    <th style="width: 46px;">#</th>
                    <th class="highlight-text">Name</th>
                    <th class="highlight-text">Email</th>
                    <th class="highlight-text">Subject</th>
                    <th class="highlight-text">Status</th>
                    <th class="highlight-text">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                    <tr class="position-relative" wire:key="message-{{ $message->id }}">
                        <td>
                            <input class="form-check-input" type="checkbox" wire:model="selectedMessages"
                                value="{{ $message->id }}">
                        </td>
                        <td>
                            <span class="fw-500">{{ $loop->iteration }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.contact-messages.show', $message) }}" class="user-name mb-0">
                                {{ $message->first_name }} {{ $message->last_name }}
                            </a>
                        </td>
                        <td>
                            <a href="mailto:{{ $message->email }}" class="text-dark">
                                {{ $message->email }}
                            </a>
                        </td>
                        <td>
                            <span class="text-truncate d-inline-block" style="max-width: 200px;">
                                {{ $message->subject ?? '—' }}
                            </span>
                        </td>
                        <td>
                            <select wire:change="updateStatus({{ $message->id }}, $event.target.value)"
                                class="form-select form-select-sm" style="width: auto; min-width: 100px;">
                                <option value="new" {{ $message->status === 'new' ? 'selected' : '' }}>New</option>
                                <option value="replied" {{ $message->status === 'replied' ? 'selected' : '' }}>Replied
                                </option>
                                <option value="closed" {{ $message->status === 'closed' ? 'selected' : '' }}>Closed
                                </option>
                            </select>
                        </td>
                        <td>{{ $message->created_at->format('d M Y') }}</td>
                        <td class="position-absolute end-0 top-0 edit-button-td">
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.contact-messages.show', $message) }}"
                                    class="btn btn-sm btn-link text-white p-0 text-decoration-none edit-button fs-24">
                                    <i class="lni lni-eye"></i>
                                </a>
                                <button wire:click="delete({{ $message->id }})"
                                    wire:confirm="Are you sure you want to delete this message?"
                                    class="btn btn-sm btn-link text-white p-0 text-decoration-none edit-button fs-24">
                                    <i class="lni lni-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="lni lni-envelope fs-1 d-block mb-3 opacity-50"></i>
                            No contact messages found.
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
            <li class="page-item {{ $messages->onFirstPage() ? 'disabled' : '' }}">
                <a href="#" class="page-link text-dark" wire:click.prevent="previousPage">
                    Previous
                </a>
            </li>

            <!-- Page Numbers -->
            @for ($p = 1; $p <= $messages->lastPage(); $p++)
                <li class="page-item {{ $messages->currentPage() == $p ? 'active' : '' }}">
                    <a href="#"
                        class="page-link {{ $messages->currentPage() == $p ? 'bg-dark text-white border-dark' : 'text-dark' }}"
                        wire:click.prevent="gotoPage({{ $p }})">
                        {{ $p }}
                    </a>
                </li>
            @endfor

            <!-- Next -->
            <li class="page-item {{ $messages->currentPage() == $messages->lastPage() ? 'disabled' : '' }}">
                <a href="#" class="page-link text-dark" wire:click.prevent="nextPage">
                    Next
                </a>
            </li>
        </ul>
    </nav>

    {{-- Success Toast at Bottom Right --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show position-fixed bottom-0 end-0 m-4"
            style="z-index: 9999; min-width: 300px; box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);" role="alert">
            <div class="d-flex justify-content-between align-items-center">
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
</div>

</div>
