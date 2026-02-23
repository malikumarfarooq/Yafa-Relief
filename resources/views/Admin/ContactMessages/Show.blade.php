<x-admin.layout
    tabTitle="View Message"
    pageTitle="Contact Messages"
    breadcrumb="Contact Messages">

    <div class="row">
        {{-- Message Details --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-semibold">Message Details</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="150">Name</th>
                            <td>{{ $contactMessage->first_name }} {{ $contactMessage->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>
                                <a href="mailto:{{ $contactMessage->email }}">
                                    {{ $contactMessage->email }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $contactMessage->phone ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td>{{ $contactMessage->subject ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td>{{ $contactMessage->message }}</td>
                        </tr>
                        <tr>
                            <th>Received At</th>
                            <td>{{ $contactMessage->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-semibold">Update Status</h5>
                </div>
                <div class="card-body">
                    <p class="mb-2">Current Status:
                        @if($contactMessage->status === 'new')
                            <span class="badge bg-primary">New</span>
                        @elseif($contactMessage->status === 'replied')
                            <span class="badge bg-success">Replied</span>
                        @else
                            <span class="badge bg-secondary">Closed</span>
                        @endif
                    </p>
                    <form action="{{ route('admin.contact-messages.update-status', $contactMessage) }}" method="POST">
                        @csrf
                        <select name="status" class="form-select mb-3">
                            <option value="new"     {{ $contactMessage->status === 'new'     ? 'selected' : '' }}>New</option>
                            <option value="replied" {{ $contactMessage->status === 'replied' ? 'selected' : '' }}>Replied</option>
                            <option value="closed"  {{ $contactMessage->status === 'closed'  ? 'selected' : '' }}>Closed</option>
                        </select>
                        <button type="submit" class="btn btn-primary w-100">
                            Update Status
                        </button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-semibold">Actions</h5>
                </div>
                <div class="card-body d-flex flex-column gap-2">
                    <a href="mailto:{{ $contactMessage->email }}"
                       class="btn btn-outline-primary w-100">
                        <i class="lni lni-envelope"></i> Reply via Email
                    </a>
                    <a href="{{ route('admin.contact-messages.index') }}"
                       class="btn btn-outline-secondary w-100">
                        <i class="lni lni-arrow-left"></i> Back to List
                    </a>
                    <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this message?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="lni lni-trash"></i> Delete Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-admin.layout>