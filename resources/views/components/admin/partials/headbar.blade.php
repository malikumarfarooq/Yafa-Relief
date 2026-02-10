<!-- Content Label -->
<div class="content-area-label d-flex align-items-center justify-content-between">
    <h5 class="mb-0 highlight-text fs-16 content-screen-label">{{ $breadcrumb }}</h5>
    <div class="date-day fs-16">
        Today is <strong>{{ \Carbon\Carbon::now()->format('l, d M Y') }}</strong>
    </div>
</div>
<!-- End Content Label -->
<!-- Sreen Heading -->
<div class="d-flex align-items-center justify-content-between">
    <h2 class="content-screen-heading my-3">{!! $pageTitle !!}</h2>
</div>
<!-- End Sreen Heading -->