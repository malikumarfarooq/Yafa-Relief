<x-website.layout
    metaTitle="Protect the Legacy to helping Black, Indigenous, and People of Color (BIPOC) retain their land and property ownership "
    metaDescription="Welcome to Auntie Legacy, a non-profit organization dedicated to helping Black, Indigenous, and People of Color (BIPOC) retain their land and property ownership across the United States. Join us in our mission to protect generational wealth and support families in need."
    metaKeywords="Auntie Legacy, BIPOC land ownership, non-profit organization, property retention, generational wealth, legal support, community empowerment">
    <section class="home-hero d-flex flex-column align-items-center justify-content-center">
        <div class="hero-video-overlay" id="heroVideoOverlay" aria-hidden="true">
            <video id="heroVideo" playsinline muted controls style="display: none;"></video>
            <div class="hero-video-youtube" id="heroVideoYoutube"></div>
            <button type="button" class="hero-video-close" id="heroVideoClose" aria-label="Close video">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24 8L8 24M8 8L24 24" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        <div class="container position-relative">
            <div class="hero-content" id="heroContent">
                <div class="hero-slides">
                    <div class="hero-slide active" data-slide="0" data-video-src="/src/videos/slide.mp4">
                        <img src="/src/icons/global-hero-heart.svg" alt="">
                        <h1 class="h1-title">Saving Lives Today. <span>Empowering</span> Futures Tomorrow.</h1>
                        <div class="d-flex align-items-center gap-3 hero-play-sec mt-4">
                            <div class="hero-play-btn" id="heroPlayBtn" role="button" tabindex="0"
                                aria-label="Play video">
                                <img src="/src/images/hero-play.png" alt="">
                            </div>
                            <div class="">
                                <p class="global-text text-white">
                                    When crisis strikes, Yafa Relief delivers immediate humanit-arian aid — providing
                                    urgent medical
                                    care, essential supplies, and lasting hope to communities in need.
                                </p>
                                <a href="#"
                                    class="btn d-flex justify-content-center align-items-center gap-2 mt-3">Donate Now
                                    <img src="/src/icons/btn-arrow.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="hero-slide" data-slide="1" data-video-src="/src/videos/slide.mp4">
                        <img src="/src/icons/global-hero-heart.svg" alt="">
                        <h1 class="h1-title">Together We <span>Deliver</span> Hope &amp; Relief.</h1>
                        <div class="d-flex align-items-center gap-3 hero-play-sec mt-4">
                            <div class="hero-play-btn" role="button" tabindex="0" aria-label="Play video">
                                <img src="/src/images/hero-play.png" alt="">
                            </div>
                            <div class="">
                                <p class="global-text text-white">
                                    From emergency response to long-term recovery, we stand with families and
                                    communities
                                    to restore dignity and build a safer tomorrow.
                                </p>
                                <a href="#"
                                    class="btn d-flex justify-content-center align-items-center gap-2 mt-3">Donate Now
                                    <img src="/src/icons/btn-arrow.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-slider-btn d-flex flex-column justify-content-center align-items-center gap-3">
                <button type="button" id="heroSliderPrev" aria-label="Previous slide">
                    <svg width="31" height="18" viewBox="0 0 31 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.8878 0.670324C16.4584 0.241116 15.8762 0 15.2691 0C14.662 0 14.0798 0.241116 13.6504 0.670324L0.698947 13.6218C0.48028 13.833 0.305863 14.0857 0.185874 14.365C0.0658859 14.6443 0.00272806 14.9447 8.64419e-05 15.2487C-0.00255518 15.5527 0.0553728 15.8542 0.170489 16.1356C0.285605 16.4169 0.455605 16.6725 0.670569 16.8875C0.885533 17.1025 1.14116 17.2725 1.42252 17.3876C1.70389 17.5027 2.00537 17.5606 2.30936 17.558C2.61335 17.5553 2.91378 17.4922 3.1931 17.3722C3.47242 17.2522 3.72505 17.0778 3.93625 16.8591L15.2691 5.52628L26.602 16.8591C27.0338 17.2762 27.6121 17.5069 28.2124 17.5017C28.8127 17.4965 29.3869 17.2557 29.8114 16.8312C30.2358 16.4068 30.4766 15.8325 30.4818 15.2322C30.4871 14.6319 30.2563 14.0536 29.8393 13.6218L16.8878 0.670324Z"
                            fill="white" />
                    </svg>
                </button>
                <button type="button" id="heroSliderNext" aria-label="Next slide">
                    <svg width="31" height="18" viewBox="0 0 31 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.8878 16.8878C16.4584 17.317 15.8762 17.5581 15.2691 17.5581C14.662 17.5581 14.0798 17.317 13.6504 16.8878L0.698947 3.93625C0.48028 3.72505 0.305863 3.47242 0.185874 3.1931C0.0658859 2.91378 0.00272806 2.61335 8.64419e-05 2.30936C-0.00255518 2.00537 0.0553728 1.70389 0.170489 1.42252C0.285605 1.14116 0.455605 0.885532 0.670569 0.670568C0.885533 0.455604 1.14116 0.285604 1.42252 0.170488C1.70389 0.0553717 2.00537 -0.00255518 2.30936 8.64434e-05C2.61335 0.00272807 2.91378 0.0658859 3.1931 0.185874C3.47242 0.305863 3.72505 0.480279 3.93625 0.698946L15.2691 12.0318L26.602 0.698946C27.0338 0.281901 27.6121 0.0511364 28.2124 0.0563528C28.8127 0.0615691 29.3869 0.302349 29.8114 0.726835C30.2358 1.15132 30.4766 1.72555 30.4818 2.32584C30.4871 2.92613 30.2563 3.50445 29.8393 3.93625L16.8878 16.8878Z"
                            fill="white" />
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <section class="commitment-section">
        <div class="container position-relative">
            <div class="row">
                <div class="col-lg-6 mt-lg-0 mt-5">
                    <img src="/src/images/commitment.png" alt="" class="commitment-img">
                </div>
                <div class="col-lg-6">
                    <h5 class="section-badge">A COMMITMENT TO ACTION</h5>
                    <h2>
                        Yafa Relief is a grassroots non-profit providing life-saving support across Palestine’s
                        vulnerable communities.
                    </h2>
                    <div class="commitment-section-info-box d-flex align-items-center gap-3 my-4">
                        <img src="/src/icons/rocket-icon.svg" alt="Rocket Icon">
                        <p class="global-text">
                            As a dedicated charity, we provide swift disaster response, delivering timely aid to those
                            affected by conflict and emergencies.
                        </p>
                    </div>
                    <p class="global-text">
                        We deliver vital support to refugees and families affected by conflict and displacement,
                        restoring dignity, stability, and hope.
                    </p>
                    <a href="#" class="btn d-flex justify-content-center align-items-center mt-4">About Us <img
                            src="/src/icons/btn-arrow.svg" alt=""></a>
                </div>
            </div>
            <img src="/src/images/pink-sun.png" alt="" class="commitment-sun">
        </div>
    </section>

    <section class="objectives-section">
        <div class="container">
            <h5 class="section-badge text-center">OUR OBJECTIVES</h5>
            <h2 class="h2-title text-capitalize objectives-section-title">Yafa Relief is Dedicated to <span>Provide
                    Support</span></h2>
            <div class="row mt-5 objective-boxes">
                <div class="col-lg-4 col-md-6">
                    <div class="objectives-section-box">
                        <img src="/src/images/objective-box-1.png" alt="">
                        <h3 class="h3-title mt-2 mb-3">Emergency Life-Saving Relief</h3>
                        <p class="global-text">
                            We deliver urgent aid including food, clean water, medical supplies, and survival essentials
                            to families in crisis.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="objectives-section-box">
                        <img src="/src/images/objective-box-2.png" alt="">
                        <h3 class="h3-title mt-2 mb-3">Family & Economic Support</h3>
                        <p class="global-text">
                            We support vulnerable families through care programs that restore stability, ease financial
                            strain, and rebuild hope.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="objectives-section-box">
                        <img src="/src/images/objective-box-3.png" alt="">
                        <h3 class="h3-title mt-2 mb-3">Transparent Humanitarian Aid</h3>
                        <p class="global-text">
                            Every donation is managed responsibly, ensuring support reaches those who need it most with
                            clarity and trust.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="objectives-section-box">
                        <img src="/src/images/objective-box-4.png" alt="">
                        <h3 class="h3-title mt-2 mb-3">Emergency Life-Saving Relief</h3>
                        <p class="global-text">
                            Every donation is managed responsibly, ensuring support reaches those who need it most with
                            clarity and trust.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="objectives-section-box">
                        <img src="/src/images/objective-box-5.png" alt="">
                        <h3 class="h3-title mt-2 mb-3">Global Solidarity & Hope</h3>
                        <p class="global-text">
                            Every donation is managed responsibly, ensuring support reaches those who need it most with
                            clarity and trust.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="objective-donate-box">
                        <h3>Your support delivers food, clean water, & life-saving aid.</h3>
                        <a href="#" class="btn d-flex align-items-center justify-content-center mt-3">Donate Now <img
                                src="/src/icons/btn-arrow-black.svg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="supporting-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h5 class="section-badge">OUR CAUSES</h5>
                    <h2 class="h2-title">Supporting communities <span>humanitarian</span> causes</h2>
                </div>
                <div class="col-lg-5">
                    <p class="global-text">
                        We focus on impactful causes that address urgent community needs — from healthcare and education
                        to food security. Our programs are designed to deliver immediate relief while building
                        sustainable pathways for long-term stability and lasting change.
                    </p>
                </div>
            </div>
            <div class="row mt-5 supporting-boxes">
                @foreach ($urgentPrograms as $program)
                <div class="col-lg-4 col-md-6">
                    <div class="supporting-section-box">
                        <img src="{{ $program->thumbnail ? asset('/storage/'.$program->thumbnail) : asset('/src/images/our-program.webp') }}"
                            alt="{{ $program->title }}" class="supporting-box-img">
                        <div class="category-tag h6 mt-3 text-danger">{{ $program->getCategoriesStringAttribute() }}
                        </div>
                        <h3 class="h3-title mt-3 mb-3">{{ $program->title }}</h3>
                        <p class="global-text mb-2"
                            style="height: 42px; overflow: hidden; font-size: 14px; line-height: 1.4;">
                            {{ $program->short_description }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center supporting-box-info">
                            <div>
                                <h6 class="mb-0">Goals</h6>
                                <span>${{ number_format($program->goal_amount, 0) }}</span>
                            </div>
                            <div></div>
                            <div>
                                <h6 class="mb-0">Raises</h6>
                                <span>${{ number_format($program->raised_amount, 0) }}</span>
                            </div>
                            <div></div>
                            <div>
                                <h6 class="mb-0">To Go</h6>
                                <span>${{ number_format($program->goal_amount - $program->raised_amount, 0) }}</span>
                            </div>
                        </div>
                        <a href="{{ route('website.program-details', $program->slug) }}"
                            class="btn btn-dark d-flex justify-content-center align-items-center mt-3">Donate Now <img
                                src="/src/icons/btn-arrow.svg" alt=""></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="core-values-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <h5 class="section-badge">OUR CORE VALUES</h5>
                    <h2 class="h2-title">At Yafa Relief, Values Are <span>Our Compass</span></h2>
                    <p class="global-text core-values-section-description">
                        Guided by integrity and compassion, we serve communities in need. Every action reflects our
                        commitment to hope, dignity, and support
                    </p>
                    <div class="d-flex align-items-center gap-3 flex-wrap core-values-section-option my-4">
                        <span class="d-flex align-items-center gap-3"><img src="/src/icons/check-mark.svg"
                                alt="">Humanity</span>
                        <span class="d-flex align-items-center gap-3"><img src="/src/icons/check-mark.svg"
                                alt="">Neutrality</span>
                        <span class="d-flex align-items-center gap-3"><img src="/src/icons/check-mark.svg"
                                alt="">Sustainability</span>
                        <span class="d-flex align-items-center gap-3"><img src="/src/icons/check-mark.svg"
                                alt="">Integrity</span>
                        <span class="d-flex align-items-center gap-3"><img src="/src/icons/check-mark.svg"
                                alt="">Partnership</span>
                        <span class="d-flex align-items-center gap-3"><img src="/src/icons/check-mark.svg"
                                alt="">Solidarity</span>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="core-values-box">
                                <h3>662+</h3>
                                <span>Children Educated</span>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-lg-0 mt-4">
                            <div class="core-values-box">
                                <h3>276k+</h3>
                                <span>liters of water</span>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-lg-0 mt-4">
                            <div class="core-values-box">
                                <h3>33k+</h3>
                                <span>Meals delivered</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 d-lg-flex d-none flex-column justify-content-center">
                    <img src="/src/images/pink-sun.png" alt="" class="core-values-sun">
                </div>
                <div class="col-lg-5 mt-lg-0 mt-5">
                    <img src="/src/images/core-values.png" alt="" class="core-values-img">
                </div>
            </div>
        </div>
    </section>

    <section class="program-section">
        <div class="container">
            <h5 class="section-badge text-center">OUR PROGRAMS</h5>
            <h2 class="h2-title text-center text-capitalize">Providing hope where it’s <span>needed most</span></h2>
            <p class="global-text text-center program-section-description mt-3">
                Together, we support vulnerable communities with care and compassion. Delivering meaningful action that
                creates lasting impact for generations.
            </p>
            <div class="row mt-5 program-boxes">
                @foreach ($featuredPrograms as $program )
                <div class="col-md-6">
                    <div class="program-box p-4" style="background: url('{{ $program->thumbnail ? asset('/storage/'.$program->thumbnail) : asset('/src/images/our-program.webp') }}') center / cover no-repeat !important;">
                        <div class="program-box-inner">
                            <div class="category-tag h6 mt-3 text-warning">{{ $program->getCategoriesStringAttribute() }}</div>
                            <h3 class="h3-title mb-3 mt-3">{{ $program->title }}</h3>
                            <div class="d-lg-flex justify-content-between align-items-center">
                                <p class="global-text text-white h6">
                                    {{ $program->short_description }}
                                </p>
                                <a href="{{ route('website.program-details', $program->slug) }}" class="btn d-flex align-items-center ms-3 px-3">Donate Now <img
                                        src="/src/icons/btn-arrow.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="stories-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h5 class="section-badge text-uppercase">STORIES Highlights</h5>
                    <h2 class="h2-title text-capitalize">Stories of impact <span>and hope</span></h2>
                </div>
                <div class="col-lg-4">
                    <p class="global-text">
                        Stay updated with our latest initiatives, humanitarian stories, and ongoing efforts from the
                        field. Discover how your support is making a real difference in the lives of those who need it
                        most.
                    </p>
                </div>
            </div>
            <div class="stories-slider mt-5">
                <div class="stories-track">
                    <div class="stories-box">
                        <img src="/src/images/stories-box.webp" alt="" class="stories-img">
                        <div class="d-flex align-items-center gap-3 mt-3">
                            <div class="d-flex align-items-center gap-2 stories-author"><img
                                    src="/src/icons/stories-user.svg" alt="">Burak Deniz</div>
                            <div class="d-flex align-items-center gap-2 stories-author"><img
                                    src="/src/icons/calendar.svg" alt="">20 Jan, 2026</div>
                        </div>
                        <h3 class="h3-title mt-3">Empowering Refugee Communities</h3>
                        <p class="global-text">
                            Discover how our programs are helping children and families regain hope and stability...
                        </p>
                        <a href="#" class="btn d-flex justify-content-center align-items-center mt-3">Read More <img
                                src="/src/icons/btn-arrow.svg" alt=""></a>
                    </div>
                    <div class="stories-box">
                        <img src="/src/images/stories-box.webp" alt="" class="stories-img">
                        <div class="d-flex align-items-center gap-3 mt-3">
                            <div class="d-flex align-items-center gap-2 stories-author"><img
                                    src="/src/icons/stories-user.svg" alt="">Burak Deniz</div>
                            <div class="d-flex align-items-center gap-2 stories-author"><img
                                    src="/src/icons/calendar.svg" alt="">20 Jan, 2026</div>
                        </div>
                        <h3 class="h3-title mt-3">Empowering Refugee Communities</h3>
                        <p class="global-text">
                            Discover how our programs are helping children and families regain hope and stability...
                        </p>
                        <a href="#" class="btn d-flex justify-content-center align-items-center mt-3">Read More <img
                                src="/src/icons/btn-arrow.svg" alt=""></a>
                    </div>
                    <div class="stories-box">
                        <img src="/src/images/stories-box.webp" alt="" class="stories-img">
                        <div class="d-flex align-items-center gap-3 mt-3">
                            <div class="d-flex align-items-center gap-2 stories-author"><img
                                    src="/src/icons/stories-user.svg" alt="">Burak Deniz</div>
                            <div class="d-flex align-items-center gap-2 stories-author"><img
                                    src="/src/icons/calendar.svg" alt="">20 Jan, 2026</div>
                        </div>
                        <h3 class="h3-title mt-3">Empowering Refugee Communities</h3>
                        <p class="global-text">
                            Discover how our programs are helping children and families regain hope and stability...
                        </p>
                        <a href="#" class="btn d-flex justify-content-center align-items-center mt-3">Read More <img
                                src="/src/icons/btn-arrow.svg" alt=""></a>
                    </div>
                    <div class="stories-box">
                        <img src="/src/images/stories-box.webp" alt="" class="stories-img">
                        <div class="d-flex align-items-center gap-3 mt-3">
                            <div class="d-flex align-items-center gap-2 stories-author"><img
                                    src="/src/icons/stories-user.svg" alt="">Burak Deniz</div>
                            <div class="d-flex align-items-center gap-2 stories-author"><img
                                    src="/src/icons/calendar.svg" alt="">20 Jan, 2026</div>
                        </div>
                        <h3 class="h3-title mt-3">Empowering Refugee Communities</h3>
                        <p class="global-text">
                            Discover how our programs are helping children and families regain hope and stability...
                        </p>
                        <a href="#" class="btn d-flex justify-content-center align-items-center mt-3">Read More <img
                                src="/src/icons/btn-arrow.svg" alt=""></a>
                    </div>
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

    <section class="latest-news-section ">
        <div class="container position-relative">
            <h5 class="section-badge text-center">OUR LATEST NEWS</h5>
            <h2 class="h2-title text-center">Latest News <span>And Updates</span></h2>
            <p class="global-text text-center latest-news-section-desciption">
                Explore inspiring stories and updates about our initiatives, successes, and the lives we've touched.
                See how your support is creating real, lasting change in communities worldwide.
            </p>
            <div class="latest-news-boxes mt-5">
                <div class="latest-news-box d-flex align-items-center">
                    <div class="latest-date d-flex flex-column justify-content-center text-center">
                        <h3>19 January</h3>
                        <span>2026</span>
                    </div>
                    <div class="latest-news-detail d-flex justify-content-between align-items-center">
                        <div class="latest-news-img"><img src="/src/images/latest-news.png" alt=""></div>
                        <div class="latest-news-content">
                            <h5 class="section-badge">Latest News</h5>
                            <h3 class="h3-title">Emergency Response Update</h3>
                            <p class="global-text">
                                Our teams are actively delivering urgent food, shelter, and medical aid to affected
                                communities. See the latest progress from the field.
                            </p>
                        </div>
                        <div class="latest-news-btn">
                            <a href="#">
                                <svg width="56" height="56" viewBox="0 0 56 56" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect width="56" height="56" rx="28" fill="#43A047" />
                                    <path
                                        d="M17.8182 35.8826C17.1832 36.5175 17.1832 37.5469 17.8182 38.1818C18.4531 38.8168 19.4825 38.8168 20.1174 38.1818L18.9678 37.0322L17.8182 35.8826ZM38.6581 18.9677C38.6581 18.0698 37.9302 17.3419 37.0323 17.3419L22.4 17.3419C21.5021 17.3419 20.7742 18.0698 20.7742 18.9677C20.7742 19.8656 21.5021 20.5935 22.4 20.5935L35.4065 20.5935L35.4065 33.6C35.4065 34.4979 36.1344 35.2258 37.0323 35.2258C37.9302 35.2258 38.6581 34.4979 38.6581 33.6L38.6581 18.9677ZM18.9678 37.0322L20.1174 38.1818L38.1819 20.1173L37.0323 18.9677L35.8827 17.8181L17.8182 35.8826L18.9678 37.0322Z"
                                        fill="white" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="latest-news-box d-flex align-items-center">
                    <div class="latest-date d-flex flex-column justify-content-center text-center">
                        <h3>19 January</h3>
                        <span>2026</span>
                    </div>
                    <div class="latest-news-detail d-flex justify-content-between align-items-center">
                        <div class="latest-news-img"><img src="/src/images/latest-news.png" alt=""></div>
                        <div class="latest-news-content">
                            <h5 class="section-badge">Latest News</h5>
                            <h3 class="h3-title">Emergency Response Update</h3>
                            <p class="global-text">
                                Our teams are actively delivering urgent food, shelter, and medical aid to affected
                                communities. See the latest progress from the field.
                            </p>
                        </div>
                        <div class="latest-news-btn">
                            <a href="#">
                                <svg width="56" height="56" viewBox="0 0 56 56" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect width="56" height="56" rx="28" fill="#43A047" />
                                    <path
                                        d="M17.8182 35.8826C17.1832 36.5175 17.1832 37.5469 17.8182 38.1818C18.4531 38.8168 19.4825 38.8168 20.1174 38.1818L18.9678 37.0322L17.8182 35.8826ZM38.6581 18.9677C38.6581 18.0698 37.9302 17.3419 37.0323 17.3419L22.4 17.3419C21.5021 17.3419 20.7742 18.0698 20.7742 18.9677C20.7742 19.8656 21.5021 20.5935 22.4 20.5935L35.4065 20.5935L35.4065 33.6C35.4065 34.4979 36.1344 35.2258 37.0323 35.2258C37.9302 35.2258 38.6581 34.4979 38.6581 33.6L38.6581 18.9677ZM18.9678 37.0322L20.1174 38.1818L38.1819 20.1173L37.0323 18.9677L35.8827 17.8181L17.8182 35.8826L18.9678 37.0322Z"
                                        fill="white" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="latest-news-box d-flex align-items-center">
                    <div class="latest-date d-flex flex-column justify-content-center text-center">
                        <h3>19 January</h3>
                        <span>2026</span>
                    </div>
                    <div class="latest-news-detail d-flex justify-content-between align-items-center">
                        <div class="latest-news-img"><img src="/src/images/latest-news.png" alt=""></div>
                        <div class="latest-news-content">
                            <h5 class="section-badge">Latest News</h5>
                            <h3 class="h3-title">Emergency Response Update</h3>
                            <p class="global-text">
                                Our teams are actively delivering urgent food, shelter, and medical aid to affected
                                communities. See the latest progress from the field.
                            </p>
                        </div>
                        <div class="latest-news-btn">
                            <a href="#">
                                <svg width="56" height="56" viewBox="0 0 56 56" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect width="56" height="56" rx="28" fill="#43A047" />
                                    <path
                                        d="M17.8182 35.8826C17.1832 36.5175 17.1832 37.5469 17.8182 38.1818C18.4531 38.8168 19.4825 38.8168 20.1174 38.1818L18.9678 37.0322L17.8182 35.8826ZM38.6581 18.9677C38.6581 18.0698 37.9302 17.3419 37.0323 17.3419L22.4 17.3419C21.5021 17.3419 20.7742 18.0698 20.7742 18.9677C20.7742 19.8656 21.5021 20.5935 22.4 20.5935L35.4065 20.5935L35.4065 33.6C35.4065 34.4979 36.1344 35.2258 37.0323 35.2258C37.9302 35.2258 38.6581 34.4979 38.6581 33.6L38.6581 18.9677ZM18.9678 37.0322L20.1174 38.1818L38.1819 20.1173L37.0323 18.9677L35.8827 17.8181L17.8182 35.8826L18.9678 37.0322Z"
                                        fill="white" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <img src="/src/images/pink-sun.png" alt="" class="latest-news-sun">
        </div>
    </section>
</x-website.layout>