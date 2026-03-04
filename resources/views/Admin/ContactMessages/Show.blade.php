<x-admin.layout tabTitle="View Message" pageTitle="Contact Messages" breadcrumb="Contact Messages">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            <div class="card border-0 shadow-sm">
                <div class="list-group list-group-flush">
                    <a href="{{ route('admin.contact-messages.index') }}"
                        class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-3 {{ request()->routeIs('admin.contact-messages.index') ? 'active' : '' }}">
                        <i class="lni lni-inbox"></i>
                        <span>All Messages</span>
                        <span
                            class="badge bg-primary bg-opacity-10 text-primary ms-auto">{{ $totalMessages ?? 0 }}</span>
                    </a>
                    <a href="{{ route('admin.contact-messages.index', ['status' => 'new']) }}"
                        class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-3">
                        <i class="lni lni-envelope"></i>
                        <span>New Messages</span>
                        <span class="badge bg-primary bg-opacity-10 text-primary ms-auto">{{ $newMessages ?? 0 }}</span>
                    </a>
                    <a href="{{ route('admin.contact-messages.index', ['status' => 'replied']) }}"
                        class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-3">
                        <i class="lni lni-checkmark-circle"></i>
                        <span>Replied</span>
                        <span
                            class="badge bg-success bg-opacity-10 text-success ms-auto">{{ $repliedMessages ?? 0 }}</span>
                    </a>
                    <a href="{{ route('admin.contact-messages.index', ['status' => 'closed']) }}"
                        class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-3">
                        <i class="lni lni-close"></i>
                        <span>Closed</span>
                        <span
                            class="badge bg-secondary bg-opacity-10 text-secondary ms-auto">{{ $closedMessages ?? 0 }}</span>
                    </a>
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-3">
                <div class="card-body">
                    <h6 class="fw-semibold mb-3">Quick Filters</h6>
                    <div class="d-flex flex-column gap-2">
                        <a href="{{ route('admin.contact-messages.index', ['date' => 'today']) }}"
                            class="text-decoration-none text-dark d-flex align-items-center gap-2">
                            <i class="lni lni-calendar" style="font-size: 14px;"></i>
                            <span>Today</span>
                        </a>
                        <a href="{{ route('admin.contact-messages.index', ['date' => 'week']) }}"
                            class="text-decoration-none text-dark d-flex align-items-center gap-2">
                            <i class="lni lni-calendar" style="font-size: 14px;"></i>
                            <span>This Week</span>
                        </a>
                        <a href="{{ route('admin.contact-messages.index', ['date' => 'month']) }}"
                            class="text-decoration-none text-dark d-flex align-items-center gap-2">
                            <i class="lni lni-calendar" style="font-size: 14px;"></i>
                            <span>This Month</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', [
                'sectionTitle' => 'Message Details',
                'isBackButton' => true,
                'backURL' => route('admin.contact-messages.index'),
                'isActionButton' => false,
            ])

            <div class="content-wrapper">
                <div class="row">
                    {{-- Message Details --}}
                    <div class="col-md-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="row g-4">
                                    {{-- Sender Information --}}
                                    <div class="col-12">
                                        <h6 class="fw-semibold mb-3">Sender Information</h6>
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td width="120" class="text-muted">Name</td>
                                                    <td class="fw-medium">{{ $contactMessage->first_name }}
                                                        {{ $contactMessage->last_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">Email</td>
                                                    <td>
                                                        <a href="mailto:{{ $contactMessage->email }}"
                                                            class="text-decoration-none">
                                                            {{ $contactMessage->email }}
                                                            <i class="lni lni-envelope ms-1"
                                                                style="font-size: 14px;"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">Phone</td>
                                                    <td>
                                                        @if ($contactMessage->phone)
                                                            <a href="tel:{{ $contactMessage->phone }}"
                                                                class="text-decoration-none">
                                                                {{ $contactMessage->phone }}
                                                                <i class="lni lni-phone ms-1"
                                                                    style="font-size: 14px;"></i>
                                                            </a>
                                                        @else
                                                            <span class="text-muted">—</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">Received</td>
                                                    <td>
                                                        <span class="text-muted">
                                                            {{ $contactMessage->created_at->format('d M Y, h:i A') }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- Message Content --}}
                                    <div class="col-12">
                                        <hr class="my-2">
                                        <h6 class="fw-semibold mb-3 mt-3">Message Content</h6>

                                        @if ($contactMessage->subject)
                                            <div class="mb-3">
                                                <label class="text-muted small mb-1">Subject</label>
                                                <div class="p-3 bg-light rounded">
                                                    {{ $contactMessage->subject }}
                                                </div>
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label class="text-muted small mb-1">Message</label>
                                            <div class="p-3 bg-light rounded" style="white-space: pre-wrap;">
                                                {{ $contactMessage->message }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions & Status --}}
                    <div class="col-md-4">
                        {{-- Status Update Card --}}
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white border-0 py-3">
                                <h6 class="fw-semibold mb-0">Update Status</h6>
                            </div>
                            <div class="card-body pt-0">
                                <div class="mb-3">
                                    <label class="text-muted small mb-2">Current Status</label>
                                    <div class="mb-3">
                                        @if ($contactMessage->status === 'new')
                                            <span
                                                class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                                <i class="lni lni-envelope me-1"></i> New
                                            </span>
                                        @elseif($contactMessage->status === 'replied')
                                            <span
                                                class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                                <i class="lni lni-checkmark-circle me-1"></i> Replied
                                            </span>
                                        @else
                                            <span
                                                class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                                                <i class="lni lni-close me-1"></i> Closed
                                            </span>
                                        @endif
                                    </div>

                                    <form action="{{ route('admin.contact-messages.update-status', $contactMessage) }}"
                                        method="POST">
                                        @csrf
                                        <label class="text-muted small mb-2">Change Status</label>
                                        <select name="status" class="form-select mb-3">
                                            <option value="new"
                                                {{ $contactMessage->status === 'new' ? 'selected' : '' }}>New</option>
                                            <option value="replied"
                                                {{ $contactMessage->status === 'replied' ? 'selected' : '' }}>Replied
                                            </option>
                                            <option value="closed"
                                                {{ $contactMessage->status === 'closed' ? 'selected' : '' }}>Closed
                                            </option>
                                        </select>
                                        <button type="submit" class="btn btn-dark w-100">
                                            <i class="lni lni-sync me-1"></i> Update Status
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Quick Actions Card --}}
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-0 py-3">
                                <h6 class="fw-semibold mb-0">Quick Actions</h6>
                            </div>
                            <div class="card-body pt-0">
                                <div class="d-flex flex-column gap-2">
                                    <a href="mailto:{{ $contactMessage->email }}"
                                        class="btn btn-outline-dark w-100 text-start">
                                        <i class="lni lni-reply me-2"></i> Reply via Email
                                    </a>

                                    <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this message?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger w-100 text-start">
                                            <i class="lni lni-trash me-2"></i> Delete Message
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Metadata Card --}}
                        <div class="card border-0 shadow-sm mt-4">
                            <div class="card-header bg-white border-0 py-3">
                                <h6 class="fw-semibold mb-0">Message Info</h6>
                            </div>
                            <div class="card-body pt-0">
                                <div class="d-flex flex-column gap-2 small">
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Message ID</span>
                                        <span class="fw-medium">#{{ $contactMessage->id }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Last Updated</span>
                                        <span
                                            class="fw-medium">{{ $contactMessage->updated_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">IP Address</span>
                                        <span class="fw-medium">{{ $contactMessage->ip_address ?? '—' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Success Message Toast --}}
    @if (session()->has('success'))
        <div class="alert alert-success mt-3 d-flex justify-content-between align-items-center gap-3"
            style="position: fixed; bottom: 0px; right: 40px; z-index: 9999;">
            <span class="pe-5">{{ session('success') }}</span>
            <span style="font-size: 48px" class="position-absolute top-50 start-100 translate-middle">😎</span>
        </div>
    @endif
</x-admin.layout>
