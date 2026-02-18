<x-website.layout metaTitle="{{ $news->title }}" metaDescription="{{ $news->short_description }}"
    metaKeywords="Auntie Legacy, BIPOC land ownership, non-profit organization, property retention, generational wealth, legal support, community empowerment">
    <section class="global-hero-section news-detail-hero-sec d-flex justify-content-center flex-column"
        style="background-image: url({{ $news->cover_image
                                    ? asset('storage/'.$news->cover_image)
                                    : asset('/admin-assets/images/image.png') }}) !important; background-size: cover; background-position: center; background-repeat: no-repeat">
        <div class="container">
            <ul class="p-0 m-0 blog-breadcrum d-flex align-items-center">
                <li><a href="/">Home</a></li>
                <li><img src="/src/icons/blog-detail-white-cart.svg" alt=""></li>
                <li><a href="/our-news">NEWS</a></li>
                <li><img src="/src/icons/blog-detail-green-cart.svg" alt=""></li>
                <li><a href="/our-news/{{ $news->slug }}" class="text-uppercase active">{{$news->title}}</a></li>
            </ul>
            <h1>{!! $news->getHighlightedTitleAttribute() !!}</h1>
            <p class="global-text text-white">
                {{ $news->short_description }}
            </p>
            <div class="d-flex align-items-center blog-detail-author mt-4">
                <div class="d-flex align-items-center gap-3">
                    <img src="/src/icons/blog-detail-user.svg" alt="">
                    <h6 class="mb-0">Yafa Relief Team</h6>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <img src="/src/icons/blog-detail-calendar.svg" alt="">
                    <h6 class="mb-0">{{$news->created_at->format('d M, Y')}}</h6>
                </div>
            </div>
        </div>
    </section>

    <section class="news-detail-section">
        <article class="container">
            {!! $news->description !!}
        </article>
    </section>

    <section class="stories-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h5 class="section-badge text-uppercase">Humanity at Work</h5>
                    <h2 class="h2-title text-capitalize">Related <span>News</span></h2>
                </div>
                <div class="col-lg-5">
                    <p class="global-text">
                        Stay informed about our latest field activities and rapid response initiatives supporting
                        communities in urgent need. These updates highlight real-time action and continued commitment to
                        humanity.
                    </p>
                </div>
            </div>
            <div class="stories-slider mt-5">
                <div class="stories-track">
                    @foreach($relatedNews as $relatedNew)
                    <div class="stories-box">
                        <img src="{{ $relatedNew->thumbnail
                                    ? asset('storage/'.$relatedNew->thumbnail)
                                    : asset('/admin-assets/images/image.png') }}" alt="{{ $relatedNew->title }}"
                            class="stories-img">
                        <h3 class="h3-title mt-3">{{$relatedNew->title}}</h3>
                        <p class="global-text">
                            {{ Str::limit($relatedNew->short_description, 15) }}
                        </p>
                        <a href="/our-news/{{ $relatedNew->slug }}"
                            class="btn d-flex justify-content-center align-items-center mt-3">Read More <img
                                src="/src/icons/btn-arrow.svg" alt="{{ $relatedNew->title }}"></a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                <button class="stories-pervious-btn">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.3947 1.56836L22.591 3.92157L10.9818 15.6876L22.591 27.4537L20.3947 29.8069L6.27539 15.6876L20.3947 1.56836Z"
                            fill="#020D19" />
                    </svg>
                </button>
                <button class="stories-next-btn">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.9815 1.56836L8.78516 3.92157L20.3943 15.6876L8.78516 27.4537L10.9815 29.8069L25.1008 15.6876L10.9815 1.56836Z"
                            fill="#020D19" />
                    </svg>
                </button>
            </div>
        </div>
    </section>
</x-website.layout>