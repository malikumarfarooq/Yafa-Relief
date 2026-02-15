<x-admin.layout tabTitle="Donation: {{ $donation->donation_number }}" pageTitle="Donations and Donors"
    breadcrumb="Home ➔ Donations ➔ {{ $donation->donation_number }}">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Donations.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Viewing the Donation:
            '.$donation->donation_number,
            'isBackButton' =>
            true, 'backURL' => '/admin/donations', 'isActionButton' => false, 'actionButtonText' => 'Add New User',
            'actionButtonURL' => '/admin/users/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                <!-- Donation Header -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">Donation Details</h5>
                                <small class="text-muted">
                                    Donation Number: <strong>{{ $donation->donation_number }}</strong>
                                </small><br>
                                <small class="text-muted">{{ $donation->updated_at->format('d M Y h:i A') }}
                            </div>
                            <div>
                                <span class="badge bg-{{ 
                        $donation->payment_status == 'paid' ? 'success' : 
                        ($donation->payment_status == 'pending' ? 'warning' : 'secondary') 
                    }}">
                                    {{ ucfirst($donation->payment_status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <!-- Donor Information -->
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-light">
                                <strong>Donor Information</strong>
                            </div>
                            <div class="card-body">
                                <p><strong>Full Name:</strong> {{ $donation->first_name }} {{ $donation->last_name }}</p>
                                <p><strong>Email:</strong> {{ $donation->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-light">
                                <strong>Payment Information</strong>
                            </div>
                            <div class="card-body">
                                <p><strong>Payment Method:</strong> {{ ucfirst($donation->payment_method) }}</p>
                                <p><strong>Payment Provider:</strong> {{ ucfirst($donation->payment_provider ?? '-') }}
                                </p>
                                <p><strong>Transaction ID:</strong> {{ $donation->transaction_id ?? '-' }}</p>
                                <p><strong>Frequency:</strong> {{ ucfirst($donation->frequency ?? 'One-Time') }}</p>
                                <p><strong>Total Amount:</strong> ${{ number_format($donation->total_amount, 2) }}</p>

                                @if($donation->paid_at)
                                <p><strong>Paid At:</strong> {{ $donation->paid_at->format('d M Y H:i') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Donation Items -->
                <div class="card">
                    <div class="card-header bg-light">
                        <strong>Donation Items</strong>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Amount</th>
                                        <th>Quantity</th>
                                        <th>Frequency</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($donation->items as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>${{ number_format($item->amount, 2) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ ucfirst($item->frequency) }}</td>
                                        <td>${{ number_format($item->subtotal, 2) }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            No donation items found.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <th colspan="5" class="text-end">Total</th>
                                        <th>${{ number_format($donation->total_amount, 2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>