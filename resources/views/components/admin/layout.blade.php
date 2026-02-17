<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ $tabTitle }} - {{ env('APP_CRM_TITLE') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />

    <link rel="stylesheet" href="/admin-assets/css/dashboard.css">
    <link rel="stylesheet" href="/admin-assets/css/settings.css">
    <script src="/admin-assets/js/dashboard.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

</head>

<body>
    <!--Sidebar-->
    @include('components.admin.partials.sidebar')

    <div class="main-content">
        @include('components.admin.partials.headbar', ['pageTitle' => $pageTitle, 'breadcrumb' => $breadcrumb])

        <!-- Content Area -->
        <div class="content-area">
            {{ $slot }}
        </div>
        <!-- End Content Area -->
    </div>
    @include('components.admin.partials.utility')
    @stack('scripts')
</body>

</html>