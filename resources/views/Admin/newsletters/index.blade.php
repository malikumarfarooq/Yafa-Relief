<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">

    <title>Newsletter Subscribers - {{ env('APP_CRM_TITLE') }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="/admin-assets/css/dashboard.css">
    <link rel="stylesheet" href="/admin-assets/css/settings.css">
    
    <script src="/admin-assets/js/dashboard.js"></script>
</head>

<body>
    <!-- Sidebar -->
    @include('components.admin.partials.sidebar')

    <div class="main-content">
        <!-- Headbar / Top bar -->
        @include('components.admin.partials.headbar', [
            'pageTitle' => 'Newsletter Subscribers',
            'breadcrumb' => 'Newsletters'
        ])

        <!-- Content Area -->
        <div class="content-area">
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
                    <!-- Filter Form -->
                    <form method="GET" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Search email..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="subscribed" {{ request('status')==='subscribed'?'selected':'' }}>Subscribed</option>
                                    <option value="unsubscribed" {{ request('status')==='unsubscribed'?'selected':'' }}>Unsubscribed</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="lni lni-search"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Table -->
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
                                    <tr>
                                        <td>{{ $subscriber->email }}</td>
                                        <td>
                                            <span class="badge rounded-pill px-3 py-2 
                                                {{ $subscriber->status === 'subscribed' ? 'bg-success' : 'bg-danger' }}">
                                                {{ ucfirst($subscriber->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $subscriber->subscribed_at ? $subscriber->subscribed_at->format('d M Y H:i') : '—' }}</td>
                                        <td>{{ $subscriber->unsubscribed_at ? $subscriber->unsubscribed_at->format('d M Y H:i') : '—' }}</td>
                                        <td>{{ $subscriber->created_at->format('d M Y') }}</td>
                                        <td>
                                            <form action="{{ route('admin.settings.newsletters.toggle', $subscriber) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm 
                                                    {{ $subscriber->status === 'subscribed' ? 'btn-outline-warning' : 'btn-outline-success' }}">
                                                    {{ $subscriber->status === 'subscribed' ? 'Unsubscribe' : 'Resubscribe' }}
                                                </button>
                                            </form>
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

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $subscribers->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content Area -->
    </div>

    @include('components.admin.partials.utility')
    @stack('scripts')
</body>
</html>