<div>
    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-semibold">
                All Messages
                <span class="badge bg-primary ms-2">{{ $messages->total() }}</span>
            </h5>
            <a href="{{ route('admin.contact-messages.export') }}"
               class="btn btn-success btn-sm d-flex align-items-center gap-2">
                <i class="lni lni-download"></i> Export CSV
            </a>
        </div>

        <div class="card-body">

            {{-- Filters --}}
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <input type="text"
                           wire:model.live.debounce.300ms="search"
                           class="form-control"
                           placeholder="Search name, email or subject...">
                </div>
                <div class="col-md-3">
                    <select wire:model.live="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="new">New</option>
                        <option value="replied">Replied</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date"
                           wire:model.live="date"
                           class="form-control">
                </div>
                <div class="col-md-2">
                    <button wire:click="clearFilters"
                            class="btn btn-outline-secondary w-100">
                        Clear
                    </button>
                </div>
            </div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th width="100">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                            <tr wire:key="message-{{ $message->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $message->first_name }} {{ $message->last_name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->subject ?? '—' }}</td>
                                <td>
                                    <select wire:change="updateStatus({{ $message->id }}, $event.target.value)"
                                            class="form-select form-select-sm">
                                        <option value="new"     {{ $message->status === 'new'     ? 'selected' : '' }}>New</option>
                                        <option value="replied" {{ $message->status === 'replied' ? 'selected' : '' }}>Replied</option>
                                        <option value="closed"  {{ $message->status === 'closed'  ? 'selected' : '' }}>Closed</option>
                                    </select>
                                </td>
                                <td>{{ $message->created_at->format('d M Y') }}</td>
                                <td class="d-flex gap-1">
                                    {{-- View --}}
                                    <a href="{{ route('admin.contact-messages.show', $message) }}"
                                       class="btn btn-sm btn-light border">
                                        <i class="lni lni-eye"></i>
                                    </a>
                                    {{-- Delete --}}
                                    <button wire:click="delete({{ $message->id }})"
                                            wire:confirm="Are you sure you want to delete this message?"
                                            class="btn btn-sm btn-light border">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="lni lni-envelope fs-1 d-block mb-3 opacity-50"></i>
                                    No contact messages found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $messages->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>