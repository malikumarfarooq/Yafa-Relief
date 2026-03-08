<x-website.layout metaTitle="Our News"
    metaDescription="Welcome to Auntie Legacy, a non-profit organization dedicated to helping Black, Indigenous, and People of Color (BIPOC) retain their land and property ownership across the United States. Join us in our mission to protect generational wealth and support families in need."
    metaKeywords="Auntie Legacy, BIPOC land ownership, non-profit organization, property retention, generational wealth, legal support, community empowerment">

    <section class="global-hero-section news-hero-sec d-flex justify-content-center flex-column">
        <div class="container">
            <img src="/src/icons/global-hero-heart.svg" alt="">
            <h1>Latest News <span>& Updates</span></h1>
            <p class="global-text text-white">
                Stay updated with Yafa Relief's latest activities, emergency responses, and humanitarian efforts. From
                life-saving aid distributions to community support initiatives, this is where impact meets transparency.
            </p>
        </div>
    </section>

    <section class="news-content-section">
        <div class="container">
            <div class="row justify-content-between">

                @forelse ($news as $new)

                    {{-- First item: featured large article (left column) --}}
                    @if ($loop->first)
                        <div class="col-lg-6">
                            <div class="news-author d-flex align-items-center gap-3">
                                <div class="news-img">
                                    <img src="/admin-assets/images/logo.png" alt="Author">
                                </div>
                                <div class="news-author-detail">
                                    <h3 class="mb-0">Yafa Relief Team</h3>
                                    <p class="mb-0">Author</p>
                                </div>
                            </div>
                            <div class="h2-title my-3">
                                <a href="{{ url('/our-news/' . $new->slug) }}" class="text-decoration-none text-dark">
                                    {!! $new->getHighlightedTitleAttribute() !!}
                                </a>
                            </div>
                            <p class="news-time d-flex align-items-center gap-3 mb-5">
                                Emergency Relief <span>{{ $new->getReadingTimeAttribute() }} minutes read</span>
                            </p>
                            <img src="{{ $new->thumbnail ? asset('storage/' . $new->thumbnail) : asset('/admin-assets/images/image.png') }}"
                                alt="{{ $new->title }}" class="news-content-img mb-5">
                            <p class="global-text news-description">
                                {{ Str::limit($new->short_description, 150) }}
                                <a href="{{ url('/our-news/' . $new->slug) }}">Read more</a>
                            </p>
                        </div>

                        {{-- Remaining items: sidebar news boxes (right column) --}}
                    @else
                        @if ($loop->index === 1)
                            <div class="col-lg-5 d-flex flex-column gap-3 mt-lg-0 mt-5">
                        @endif

                        <div class="sidebar-news-box d-flex align-items-center justify-content-between">
                            <div class="sidebar-news-box-detail">
                                <h3>
                                    <a href="{{ url('/our-news/' . $new->slug) }}"
                                        class="text-decoration-none text-dark">
                                        {{ $new->title }}
                                    </a>
                                </h3>
                                <p>{{ Str::limit($new->short_description, 80) }}</p>
                                <a href="{{ url('/our-news/' . $new->slug) }}" class="d-flex align-items-center gap-2">
                                    Read more <img src="/src/icons/green-arrow.svg" alt="">
                                </a>
                            </div>
                            <div class="sidebar-news-box-img">
                                <img src="{{ $new->thumbnail ? asset('storage/' . $new->thumbnail) : asset('/src/images/gray-box.png') }}"
                                    alt="{{ $new->title }}">
                            </div>
                        </div>

                        @if ($loop->last)
            </div>
            @endif
            @endif

        @empty
            <p>No News Updates Published</p>
            @endforelse

        </div>
        </div>
    </section>

    <section class="program-section">
        <div class="container">
            <h5 class="section-badge text-center">Lives Transformed</h5>
            <h2 class="h2-title text-center text-capitalize">Recent Impact <span>Stories</span></h2>
            <p class="global-text text-center program-section-description mt-3">
                Discover how Yafa Relief's ongoing humanitarian efforts are making a real difference in vulnerable
                communities. Every story reflects hope, resilience, and the power of your support.
            </p>
            <div class="row mt-5 program-boxes">
                <div class="col-md-6">
                    <div class="program-box">
                        <div class="program-box-inner">
                            <h3 class="h3-title">Medical Aid Support for Injured Civilians</h3>
                            <div class="d-lg-flex justify-content-between align-items-center">
                                <p class="global-text text-white">
                                    Yafa Relief supplied essential medicines, first-aid kits, and medical equipment to
                                    support...
                                </p>
                                <a href="#" class="btn d-flex align-items-center">View Detail <img
                                        src="/src/icons/btn-arrow.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="program-box">
                        <div class="program-box-inner">
                            <h3 class="h3-title">Medical Aid Support for Injured Civilians</h3>
                            <div class="d-lg-flex justify-content-between align-items-center">
                                <p class="global-text text-white">
                                    Yafa Relief supplied essential medicines, first-aid kits, and medical equipment to
                                    support...
                                </p>
                                <a href="#" class="btn d-flex align-items-center">View Detail <img
                                        src="/src/icons/btn-arrow.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stories-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h5 class="section-badge text-uppercase">Humanity at Work</h5>
                    <h2 class="h2-title text-capitalize">Responding Where <span>It Matters</span></h2>
                </div>
                <div class="col-lg-4">
                    <p class="global-text">
                        Stay informed about our latest field activities and rapid response initiatives supporting
                        communities in urgent need. These updates highlight real-time action and continued commitment to
                        humanity.
                    </p>
                </div>
            </div>
            <div class="stories-slider mt-5">
                <div class="stories-track">
                    <div class="stories-box">
                        <img src="/src/images/stories-box.webp" alt="" class="stories-img">
                        <h3 class="h3-title mt-3">Empowering Refugee Communities</h3>
                        <p class="global-text">
                            Discover how our programs are helping children and families regain hope and stability...
                        </p>
                        <a href="#" class="btn d-flex justify-content-center align-items-center mt-3">Read More
                            <img src="/src/icons/btn-arrow.svg" alt=""></a>
                    </div>
                    <div class="stories-box">
                        <img src="/src/images/stories-box.webp" alt="" class="stories-img">
                        <h3 class="h3-title mt-3">Empowering Refugee Communities</h3>
                        <p class="global-text">
                            Discover how our programs are helping children and families regain hope and stability...
                        </p>
                        <a href="#" class="btn d-flex justify-content-center align-items-center mt-3">Read More
                            <img src="/src/icons/btn-arrow.svg" alt=""></a>
                    </div>
                    <div class="stories-box">
                        <img src="/src/images/stories-box.webp" alt="" class="stories-img">
                        <h3 class="h3-title mt-3">Empowering Refugee Communities</h3>
                        <p class="global-text">
                            Discover how our programs are helping children and families regain hope and stability...
                        </p>
                        <a href="#" class="btn d-flex justify-content-center align-items-center mt-3">Read More
                            <img src="/src/icons/btn-arrow.svg" alt=""></a>
                    </div>
                    <div class="stories-box">
                        <img src="/src/images/stories-box.webp" alt="" class="stories-img">
                        <h3 class="h3-title mt-3">Empowering Refugee Communities</h3>
                        <p class="global-text">
                            Discover how our programs are helping children and families regain hope and stability...
                        </p>
                        <a href="#" class="btn d-flex justify-content-center align-items-center mt-3">Read More
                            <img src="/src/icons/btn-arrow.svg" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                <button class="stories-pervious-btn">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.3947 1.56836L22.591 3.92157L10.9818 15.6876L22.591 27.4537L20.3947 29.8069L6.27539 15.6876L20.3947 1.56836Z"
                            fill="#020D19" />
                    </svg>
                </button>
                <button class="stories-next-btn">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.9815 1.56836L8.78516 3.92157L20.3943 15.6876L8.78516 27.4537L10.9815 29.8069L25.1008 15.6876L10.9815 1.56836Z"
                            fill="#020D19" />
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="/src/js/stories-slider.js"></script>

</x-website.layout>
