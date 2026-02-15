<x-admin.layout tabTitle="Donor: {{ $email }}" pageTitle="Donations and Donors"
    breadcrumb="Home ➔ Donations ➔ All Donors ➔ Viewing Donor: {{ $email }}">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Donations.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Viewing Donor:'.$email, 'isBackButton' =>
            true, 'backURL' => '/admin/donations/donors/all', 'isActionButton' => false, 'actionButtonText' => 'Add New
            Program Category',
            'actionButtonURL' => '/admin/programs/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                <!-- Page Header -->
                <div class="mb-4">
                    <h5 class="fw-bold">Donor Details</h5>
                    <p class="text-muted mb-0">
                        <strong>Email:</strong> {{ $email }}
                    </p>
                </div>

                <!-- Summary Cards -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card border-0">
                            <div class="card-body p-0">
                                <h6 class="text-muted">Total Donations</h6>
                                <h3 class="fw-bold mb-0">
                                    {{ $totalDonations }}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border-0">
                            <div class="card-body p-0">
                                <h6 class="text-muted">Total Amount Donated</h6>
                                <h3 class="fw-bold mb-0">
                                    ${{ number_format($totalAmount, 2) }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Donations Table -->

                <h5 class="mb-3">Donation History</h5>

                <div class="table-responsive table-bordered">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Donation #</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donations as $donation)
                            <tr>
                                <td><a href="/admin/donations/{{ $donation->donation_number }}" class="text-danger">{{ $donation->donation_number }}</a></td>
                                <td>{{ ucfirst($donation->payment_method) }}</td>
                                <td>
                                    <span class="badge 
                                    {{ $donation->payment_status == 'paid' ? 'bg-success' : 'bg-warning' }}">
                                        {{ ucfirst($donation->payment_status) }}
                                    </span>
                                </td>
                                <td>
                                    ${{ number_format($donation->total_amount, 2) }}
                                </td>
                                <td>
                                    {{ $donation->created_at->format('d M Y') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-3">
                                    No donations found for this donor.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $donations->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>
</x-admin.layout>