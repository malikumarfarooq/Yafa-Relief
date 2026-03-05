<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ $metaTitle }} : {{ config('app.name') }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="{{ $metaKeywords }}">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    {{-- Swiper CSS (was incorrectly placed inside a <script> tag before — fixed) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    {{-- LineIcons --}}
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />

    {{-- Site CSS --}}
    <link rel="stylesheet" href="/src/css/program-detail.css">
    <link rel="stylesheet" href="/src/css/blogs.css">
    <link rel="stylesheet" href="/src/css/about-us.css">
    <link rel="stylesheet" href="/src/css/news.css">
    <link rel="stylesheet" href="/src/css/contact-us.css">
    <link rel="stylesheet" href="/src/css/donation.css">
    <link rel="stylesheet" href="/src/css/our-program.css">
    <link rel="stylesheet" href="/src/css/cart.css">
    <link rel="stylesheet" href="/src/css/home.css">

    @stack('styles')
    @livewireStyles
</head>

<body>
    <div id="cursor-dot"></div>

    {{-- Header --}}
    @include('components.website.partials.header')

    {{-- Page content --}}
    <main>{{ $slot }}</main>

    {{-- Footer --}}
    @include('components.website.partials.footer')

    {{-- ============================================================
         DYNAMIC POPUP (from admin panel)
         Must be OUTSIDE <main> so it overlays everything.
         If no active popup exists in DB, this renders nothing.
    ============================================================ --}}
    @livewire('website.dynamic-popup')

    {{-- Cursor animation --}}
    <script>
        const dot = document.getElementById('cursor-dot');

        let mouseX = 0,
            mouseY = 0;
        let dotX = 0,
            dotY = 0;

        document.addEventListener('mousemove', e => {
            mouseX = e.clientX;
            mouseY = e.clientY;
        });

        function animate() {
            const speed = 0.15;
            dotX += (mouseX - dotX) * speed;
            dotY += (mouseY - dotY) * speed;
            dot.style.left = dotX + 'px';
            dot.style.top = dotY + 'px';
            requestAnimationFrame(animate);
        }
        animate();

        document.addEventListener('mousedown', () => dot.classList.add('clicking'));
        document.addEventListener('mouseup', () => dot.classList.remove('clicking'));
    </script>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    {{-- Swiper JS --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- Site JS --}}
    <script src="/src/js/header.js"></script>
    <script src="/src/js/hero-video-slider.js"></script>
    <script src="/src/js/stories-slider.js"></script>
    {{-- <script src="/src/js/donation-popup.js"></script> --}}

    {{-- Reminder popup (static fallback — auto-skips if dynamic popup is active) --}}
    {{-- <script src="/src/js/reminder-popup.js"></script> --}}

    {{-- Dynamic popup (driven by admin panel) --}}
    <script src="{{ asset('src/js/dynamic-popup.js') }}"></script>

    {{-- Livewire --}}
    @livewireScripts

    @stack('scripts')
</body>

</html>







{{-- <!DOCTYPE html>
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
        < link rel = "stylesheet"
        href = "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" / >
    </script>
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />


    <link rel="stylesheet" href="/src/css/program-detail.css">
    <link rel="stylesheet" href="/src/css/blogs.css">
    <link rel="stylesheet" href="/src/css/about-us.css">
    <link rel="stylesheet" href="/src/css/news.css">
    <link rel="stylesheet" href="/src/css/contact-us.css">
    <link rel="stylesheet" href="/src/css/donation.css">
    <link rel="stylesheet" href="/src/css/our-program.css">
    <link rel="stylesheet" href="/src/css/cart.css">

    <link rel="stylesheet" href="/src/css/home.css">
    @stack('styles')
    @livewireStyles
</head>

<body>
    <div id="cursor-dot"></div>
    <!--Sidebar-->
    @include('components.website.partials.header')

    <main>{{ $slot }}</main>

    @include('components.website.partials.footer')

    <script>
        const dot = document.getElementById('cursor-dot');

        let mouseX = 0,
            mouseY = 0;
        let dotX = 0,
            dotY = 0;

        document.addEventListener('mousemove', e => {
            mouseX = e.clientX;
            mouseY = e.clientY;
        });

        function animate() {
            const speed = 0.15; // 0.05 = very lazy trail, 0.3 = snappy
            dotX += (mouseX - dotX) * speed;
            dotY += (mouseY - dotY) * speed;

            dot.style.left = dotX + 'px';
            dot.style.top = dotY + 'px';

            requestAnimationFrame(animate);
        }
        animate();

        document.addEventListener('mousedown', () => dot.classList.add('clicking'));
        document.addEventListener('mouseup', () => dot.classList.remove('clicking'));
    </script>

    <script src="/src/js/header.js"></script>
    <script src="/src/js/hero-video-slider.js"></script>
    <script src="/src/js/stories-slider.js"></script>
    <script src="/src/js/reminder-popup.js"></script>
    <script src="{{ asset('src/js/dynamic-popup.js') }}"></script>
    <script src="/src/js/donation-popup.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    @livewireScripts
    <script src="/src/js/header.js"></script>
    @stack('scripts')
</body>

</html> --}}
