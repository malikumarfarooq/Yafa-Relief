<x-admin.layout tabTitle="Donation Reports" pageTitle="Donation Reports" breadcrumb="Home ➔ Donations ➔ Reports">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Donations.Partials.Navigation')
        </div>

        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', [
                'sectionTitle' => 'Donation Reports',
                'isBackButton' => false,
                'backURL' => '/admin/donations',
                'isActionButton' => false,
                'actionButtonText' => null,
                'actionButtonURL' => null,
                'btnClass' => 'btn-dark',
            ])

            <div class="content-wrapper">

                {{-- Summary cards - match dashboard style --}}
                <div class="d-flex flex-wrap gap-3 mt-1 mb-4">
                    <div class="dashboard-icon-card purple-gradiant p-3 mb-1 position-relative">
                        <i class="lni lni-label-dollar-2 position-absolute"></i>
                        <h5>Total Donations</h5>
                        <h3>{{ number_format($totalDonations) }}</h3>
                        <p class="text-white-50 mb-0 small">
                            All donations{{ $from || $to ? ' in selected range' : ' (lifetime)' }}.
                        </p>
                    </div>

                    <div class="dashboard-icon-card green-gradiant p-3 mb-1 position-relative">
                        <i class="lni lni-bar-chart-dollar position-absolute"></i>
                        <h5>Total Amount (paid)</h5>
                        <h3>{{ number_format($totalAmount, 2) }}</h3>
                        <p class="text-white-50 mb-0 small">
                            Sum of paid donations{{ $from || $to ? ' in selected range' : ' (lifetime)' }}.
                        </p>
                    </div>
                </div>

                {{-- Tables --}}
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h6 class="mb-0">Donations by Payment Status</h6>
                            </div>
                            <div class="card-body p-0">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th class="text-end">Count</th>
                                            <th class="text-end">Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($byStatus as $row)
                                            <tr>
                                                <td>{{ $row->payment_status ?: 'N/A' }}</td>
                                                <td class="text-end">{{ number_format($row->count) }}</td>
                                                <td class="text-end">{{ number_format($row->total_amount, 2) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-3">
                                                    No donations found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h6 class="mb-0">Last 7 Days (by Date)</h6>
                            </div>
                            <div class="card-body p-0">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th class="text-end">Count</th>
                                            <th class="text-end">Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($last7Days as $row)
                                            <tr>
                                                <td>{{ \Illuminate\Support\Carbon::parse($row->date)->format('Y-m-d') }}</td>
                                                <td class="text-end">{{ number_format($row->count) }}</td>
                                                <td class="text-end">{{ number_format($row->total_amount, 2) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-3">
                                                    No data for the last 7 days.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Filters --}}
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.donations.reports') }}" class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label class="form-label">From date</label>
                                <input type="date" name="from" value="{{ $from }}" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">To date</label>
                                <input type="date" name="to" value="{{ $to }}" class="form-control">
                            </div>
                            <div class="col-md-3 d-flex gap-2">
                                <button type="submit" class="btn btn-dark w-100">
                                    Apply Filters
                                </button>
                                <a href="{{ route('admin.donations.reports') }}" class="btn btn-outline-secondary">
                                    Reset
                                </a>
                            </div>
                            <div class="col-md-3 text-md-end text-muted small">
                                @if ($from || $to)
                                    Showing data for
                                    @if ($from)
                                        <strong>from {{ $from }}</strong>
                                    @endif
                                    @if ($to)
                                        <strong>to {{ $to }}</strong>
                                    @endif
                                @else
                                    Showing summary for <strong>all time</strong> and last <strong>7 days</strong>.
                                @endif
                            </div>
                        </form>
                    </div>
                </div>


                </div>
            </div>
        </div>
    </div>
</x-admin.layout>

