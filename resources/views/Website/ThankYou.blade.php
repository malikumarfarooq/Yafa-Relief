<x-website.layout metaTitle="Donation Received" metaDescription="..." metaKeywords="...">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center mb-5">
                    <div class="mb-3">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                    </div>
                    <h1 class="display-5 fw-bold">Thank You, {{ session('donation')->first_name ?? 'Supporter' }}!</h1>
                    <p class="lead text-muted">Your contribution supports families facing hunger, lack of access to education, and challenges in meeting their daily living needs.</p>
                </div>

                @if(session('donation'))
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="mb-0">Donation Receipt</h5>
                                    <small class="text-muted">No: {{ session('donation')->donation_number }}</small>
                                </div>
                                <div class="col text-end">
                                    <span class="badge bg-success-subtle text-success border border-success px-3 py-2">
                                        Status: {{ ucfirst(session('donation')->payment_status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h6 class="text-uppercase fw-bold mb-3 small text-muted">Summary of Impact</h6>
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Program / Title</th>
                                            <th class="text-center">Frequency</th>
                                            <th class="text-end">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(session('donation')->items as $item)
                                            <tr>
                                                <td>
                                                    <span class="fw-bold">{{ $item->title }}</span>
                                                </td>
                                                <td class="text-center text-capitalize">
                                                    <span class="badge rounded-pill bg-light text-dark border">
                                                        {{ $item->frequency }}
                                                    </span>
                                                </td>
                                                <td class="text-end font-monospace">${{ number_format($item->amount, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-group-divider">
                                            <td colspan="2" class="text-end fw-bold pt-3">Total Amount Paid:</td>
                                            <td class="text-end fw-bold pt-3 fs-5">${{ number_format(session('donation')->total_amount, 2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <p class="text-muted mb-1 small text-uppercase">Donor Details</p>
                                    <p class="mb-0 fw-semibold">{{ session('donation')->first_name }} {{ session('donation')->last_name }}</p>
                                    <p class="text-muted small">{{ session('donation')->email }}</p>
                                </div>
                                <div class="col-sm-6 text-sm-end">
                                    <p class="text-muted mb-1 small text-uppercase">Payment Info</p>
                                    <p class="mb-0 fw-semibold">Debit / Credit Card</p>
                                    <p class="text-muted small">via {{ ucfirst(session('donation')->payment_provider) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light py-3 text-center border-0">
                            <p class="small text-muted mb-0">A formal receipt has been sent to your email address.</p>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        Donation details are no longer available in this session.
                    </div>
                @endif

                <div class="text-center mt-5">
                    <a href="{{ url('/') }}" class="btn btn-outline-primary px-4 py-2 me-2">Return Home</a>
                    <button onclick="window.print()" class="btn btn-warning text-decoration-none">
                        <i class="bi bi-printer"></i> Print Receipt
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .btn, nav, footer { display: none !important; }
            .card { border: none !important; box-shadow: none !important; }
        }
    </style>
</x-website.layout>