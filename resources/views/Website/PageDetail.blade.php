<x-website.layout metaTitle="{{ $page->title }}"
    metaDescription="{{ $page->short_description }}"
    metaKeywords="Yafa Relief, {{ $page->title }}, non-profit, community support, land rights">

    <section class="global-hero-section news-detail-hero-sec d-flex justify-content-center flex-column"
        style="background-image: url({{ $page->cover_image
                                    ? asset('storage/'.$page->cover_image)
                                    : asset('/admin-assets/images/image.png') }}) !important; background-size: cover; background-position: center; background-repeat: no-repeat">
        <div class="container">
            <ul class="p-0 m-0 blog-breadcrum d-flex align-items-center">
                <li><a href="/">Home</a></li>
                <li><img src="/src/icons/blog-detail-white-cart.svg" alt=""></li>
                <li><a href="#" class="text-uppercase">PAGE</a></li>
                <li><img src="/src/icons/blog-detail-green-cart.svg" alt=""></li>
                <li><a href="/pages/{{ $page->slug }}" class="text-uppercase active">{{ $page->title }}</a></li>
            </ul>

            <h1>{{ $page->title }}</h1>

            @if($page->short_description)
                <p class="global-text text-white">
                    {{ $page->short_description }}
                </p>
            @endif

            <div class="d-flex align-items-center blog-detail-author mt-4">
                <div class="d-flex align-items-center gap-3">
                    <img src="/src/icons/blog-detail-user.svg" alt="">
                    <h6 class="mb-0">Yafa Relief Team</h6>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <img src="/src/icons/blog-detail-calendar.svg" alt="">
                    <h6 class="mb-0">{{ $page->created_at->format('d M, Y') }}</h6>
                </div>
            </div>
        </div>
    </section>

    <section class="news-detail-section">
        <article class="container">
            {!! $page->description !!}
        </article>
    </section>

    <!-- No related stories/blogs section or slider for Pages -->

</x-website.layout>