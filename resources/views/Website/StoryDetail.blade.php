<x-website.layout metaTitle="{{ $story->title }}" 
    metaDescription="{{ $story->short_description }}"
    metaKeywords="Yafa Relief stories, community stories, resilience stories, BIPOC empowerment, humanitarian impact, inspirational journeys">
    <section class="global-hero-section news-detail-hero-sec d-flex justify-content-center flex-column"
        style="background-image: url({{ $story->cover_image
                                    ? asset('storage/'.$story->cover_image)
                                    : asset('/admin-assets/images/image.png') }}) !important; background-size: cover; background-position: center; background-repeat: no-repeat">
        <div class="container">
            <ul class="p-0 m-0 blog-breadcrum d-flex align-items-center">
                <li><a href="/">Home</a></li>
                <li><img src="/src/icons/blog-detail-white-cart.svg" alt=""></li>
                <li><a href="/our-stories">STORIES</a></li>
                <li><img src="/src/icons/blog-detail-green-cart.svg" alt=""></li>
                <li><a href="/our-stories/{{ $story->slug }}" class="text-uppercase active">{{ $story->title }}</a></li>
            </ul>
            <h1>{!! $story->getHighlightedTitleAttribute() !!}</h1>
            <p class="global-text text-white">
                {{ $story->short_description }}
            </p>
            <div class="d-flex align-items-center blog-detail-author mt-4">
                <div class="d-flex align-items-center gap-3">
                    <img src="/src/icons/blog-detail-user.svg" alt="">
                    <h6 class="mb-0">Yafa Relief Team</h6>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <img src="/src/icons/blog-detail-calendar.svg" alt="">
                    <h6 class="mb-0">{{ $story->created_at->format('d M, Y') }}</h6>
                </div>
            </div>
        </div>
    </section>

    <section class="news-detail-section">
        <article class="container">
            {!! $story->description !!}
        </article>
    </section>

    <section class="stories-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h5 class="section-badge text-uppercase">Humanity at Work</h5>
                    <h2 class="h2-title text-capitalize">Related <span>Stories</span></h2>
                </div>
                <div class="col-lg-5">
                    <p class="global-text">
                        Dive deeper into inspiring personal journeys, community triumphs, and meaningful moments 
                        that showcase the real impact of our work and the strength of the people we serve.
                    </p>
                </div>
            </div>
            <div class="stories-slider mt-5">
                <div class="stories-track">
                    @foreach($relatedStories as $relatedStory)
                    <div class="stories-box">
                        <img src="{{ $relatedStory->thumbnail
                                    ? asset('storage/'.$relatedStory->thumbnail)
                                    : asset('/admin-assets/images/image.png') }}" alt="{{ $relatedStory->title }}"
                            class="stories-img">
                        <h3 class="h3-title mt-3">{{ $relatedStory->title }}</h3>
                        <p class="global-text">
                            {{ Str::limit($relatedStory->short_description, 15) }}
                        </p>
                        <a href="/our-stories/{{ $relatedStory->slug }}"
                            class="btn d-flex justify-content-center align-items-center mt-3">Read More <img
                                src="/src/icons/btn-arrow.svg" alt="{{ $relatedStory->title }}"></a>
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