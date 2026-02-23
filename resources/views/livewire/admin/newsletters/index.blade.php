<div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-semibold">
                All Subscribers
                <span class="badge bg-primary ms-2">{{ $subscribers->total() }}</span>
            </h5>
            <a href="{{ route('admin.settings.newsletters.export') }}"
               class="btn btn-success btn-sm d-flex align-items-center gap-2">
                <i class="lni lni-download"></i> Export CSV
            </a>
        </div>
        <div class="card-body">
            <div class="row g-3 mb-4">
                <div class="col-md-5">
                    <input type="text"
                           wire:model.live.debounce.300ms="search"
                           class="form-control"
                           placeholder="Search email...">
                </div>
                <div class="col-md-4">
                    <select wire:model.live="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="subscribed">Subscribed</option>
                        <option value="unsubscribed">Unsubscribed</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Subscribed At</th>
                            <th>Unsubscribed At</th>
                            <th>Created At</th>
                            <th width="140">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subscribers as $subscriber)
                            <tr wire:key="subscriber-{{ $subscriber->id }}">
                                <td>{{ $subscriber->email }}</td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-2
                                        {{ $subscriber->status === 'subscribed' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($subscriber->status) }}
                                    </span>
                                </td>
                                <td>{{ $subscriber->subscribed_at?->format('d M Y H:i') ?? '—' }}</td>
                                <td>{{ $subscriber->unsubscribed_at?->format('d M Y H:i') ?? '—' }}</td>
                                <td>{{ $subscriber->created_at->format('d M Y') }}</td>
                                <td>
                                    <button wire:click="toggleStatus({{ $subscriber->id }})"
                                            class="btn btn-sm {{ $subscriber->status === 'subscribed' ? 'btn-outline-warning' : 'btn-outline-success' }}">
                                        {{ $subscriber->status === 'subscribed' ? 'Unsubscribe' : 'Resubscribe' }}
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="lni lni-envelope fs-1 d-block mb-3 opacity-50"></i>
                                    No subscribers yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $subscribers->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>