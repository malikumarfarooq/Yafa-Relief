<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ $metaTitle }} : {{ config('app.name') }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="{{ $metaKeywords }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />

    <link rel="stylesheet" href="/src/css/home.css">
    <link rel="stylesheet" href="/src/css/program-detail.css">
    <link rel="stylesheet" href="/src/css/blogs.css">
    <link rel="stylesheet" href="/src/css/about-us.css">
    <link rel="stylesheet" href="/src/css/news.css">
    <link rel="stylesheet" href="/src/css/contact-us.css">
    <link rel="stylesheet" href="/src/css/css/news.css">
    <link rel="stylesheet" href="/src/css/donation.css">
    <link rel="stylesheet" href="/src/css/our-program.css">
    <link rel="stylesheet" href="/src/css/cart.css">
    @stack('scripts')
    @stack('styles')
</head>

<body>

    <!--Sidebar-->
    @include('components.website.partials.header')

    <main>{{ $slot }}</main>

    @include('components.website.partials.footer')

    <script src="/src/js/header.js"></script>
    <script src="/src/js/hero-video-slider.js"></script>
    <script src="/src/js/stories-slider.js"></script>
    <script src="/src/js/reminder-popup.js"></script>
    <script src="/src/js/donation-popup.js"></script>
</body>

</html>