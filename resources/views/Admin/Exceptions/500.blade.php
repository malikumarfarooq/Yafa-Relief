<x-admin.layout tabTitle="500" pageTitle="" breadcrumb="Server Error : 500">
    @php
    $previousUrl = url()->previous();
    $currentUrl = url()->current();

    // Fallback to dashboard if previous URL is the same,
    // or if it's a common static asset path
    if ($previousUrl === $currentUrl || str_contains($previousUrl, '.png') || str_contains($previousUrl, '.ico')) {
    $backTarget = url('/admin/dashboard');
    } else {
    $backTarget = $previousUrl;
    }
    @endphp
    <div
        class="exception-status d-flex flex-column justify-content-center align-items-center text-center w-100 dvh-100">
        <h1 class="exception-code display-1 fw-bold mb-3">500</h1>
        <h2 class="exception-message fs-24 fw-semibold mb-3">Something went wrong on the server.</h2>
        <p class="exception-description fs-16 text-muted mb-4">Sorry for the inconvenience — we’re fixing it.</p>
        <p class="text-gray-500">
            @if(config('app.debug'))
        <div class="rounded bg-light text-muted p-3 text-start">
            <h5 class="text-danger">Error Details:</h5>
            {{ $exception->getMessage() }}
        </div>
        @endif
        </p>
        <a href="{{ $backTarget }}" class="back-btn d-flex align-items-center gap-2 fs-16">
            <i class="lni lni-arrow-left-circle"></i> Go Back
        </a>

    </div>
</x-admin.layout>