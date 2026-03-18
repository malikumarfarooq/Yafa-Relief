<x-admin.layout tabTitle="Donation Analytics" pageTitle="Donation Analytics" breadcrumb="Home ➔ Donations ➔ Analytics">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Donations.Partials.Navigation')
        </div>

        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', [
                'sectionTitle' => 'Analytics Overview',
                'isBackButton' => false,
                'backURL' => '/admin/donations',
                'isActionButton' => false,
                'actionButtonText' => null,
                'actionButtonURL' => null,
                'btnClass' => 'btn-dark',
            ])

            <div class="content-wrapper">
                <div class="d-flex flex-wrap gap-3 mt-1 mb-4">
                    <div class="dashboard-icon-card purple-gradiant p-3 mb-1 position-relative">
                        <i class="lni lni-label-dollar-2 position-absolute"></i>
                        <h5>Total Donations</h5>
                        <h3>{{ number_format($totalDonations) }}</h3>
                        <p class="text-white-50 mb-0 small">All time donations.</p>
                    </div>

                    <div class="dashboard-icon-card green-gradiant p-3 mb-1 position-relative">
                        <i class="lni lni-bar-chart-dollar position-absolute"></i>
                        <h5>Total Paid Amount</h5>
                        <h3>{{ number_format($totalPaidAmount, 2) }}</h3>
                        <p class="text-white-50 mb-0 small">Confirmed paid donations.</p>
                    </div>

                    <div class="dashboard-icon-card orange-gradiant p-3 mb-1 position-relative">
                        <i class="lni lni-hourglass-2 position-absolute"></i>
                        <h5>Pending Amount</h5>
                        <h3>{{ number_format($totalPendingAmount, 2) }}</h3>
                        <p class="text-white-50 mb-0 small">Awaiting confirmation.</p>
                    </div>

                    <div class="dashboard-icon-card blue-gradiant p-3 mb-1 position-relative">
                        <i class="lni lni-calendar-4 position-absolute"></i>
                        <h5>This Month's Donations</h5>
                        <h3>{{ number_format($thisMonthDonations) }}</h3>
                        <p class="text-white-50 mb-0 small">Donations created since month start.</p>
                    </div>

                    <div class="dashboard-icon-card yellow-gradiant p-3 mb-1 position-relative">
                        <i class="lni lni-line-double-up position-absolute"></i>
                        <h5>Average Donation</h5>
                        <h3>{{ number_format($averageDonation ?? 0, 2) }}</h3>
                        <p class="text-white-50 mb-0 small">Average of paid donations.</p>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-7">
                        <div class="card h-100">
                            <div class="card-header">
                                <h6 class="mb-0">Top Programs by Raised Amount</h6>
                            </div>
                            <div class="card-body p-0">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Program</th>
                                            <th class="text-end">Donations</th>
                                            <th class="text-end">Total Raised</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($topPrograms as $program)
                                            <tr>
                                                <td>{{ $program->title ?? 'Unknown Program' }}</td>
                                                <td class="text-end">{{ number_format($program->donations_count) }}</td>
                                                <td class="text-end">{{ number_format($program->total_raised, 2) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-3">
                                                    No donation data available yet.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="card h-100">
                            <div class="card-header">
                                <h6 class="mb-0">Today vs This Month</h6>
                            </div>
                            <div class="card-body">
                                <p class="mb-2">
                                    <strong>Today's donations:</strong>
                                    {{ number_format($todayDonations) }}
                                </p>
                                <p class="mb-2">
                                    <strong>This month's donations:</strong>
                                    {{ number_format($thisMonthDonations) }}
                                </p>
                                <p class="text-muted small mb-0">
                                    This card gives you a quick snapshot comparing today to the current month.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>

