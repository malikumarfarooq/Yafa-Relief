<x-website.layout metaTitle="Our Stories"
    metaDescription="Explore inspiring stories of resilience, community strength, and impact from Yafa Relief. Read real-life experiences and journeys that highlight our mission to support families and protect generational wealth."
    metaKeywords="Yafa Relief stories, community stories, resilience stories, BIPOC empowerment, humanitarian impact, inspirational journeys">
    <section class="global-hero-section news-hero-sec d-flex justify-content-center flex-column">
        <div class="container">
            <img src="/src/icons/global-hero-heart.svg" alt="">
            <h1>Our Stories <span>& Experiences</span></h1>
            <p class="global-text text-white">
                Discover heartfelt stories from the communities we serve, emergency responses that made a difference, 
                and the real human impact behind every initiative at Yafa Relief.
            </p>
        </div>
    </section>

    <section class="news-content-section">
        <div class="container">
            <div class="row justify-content-between">
                @forelse ($stories as $story)
                <article class="col-lg-6 mb-5" itemscope itemtype="https://schema.org/Article">

                    <!-- Author -->
                    <div class="news-author d-flex align-items-center gap-3" itemprop="author" itemscope
                        itemtype="https://schema.org/Organization">
                        <div class="news-img">
                            <img src="/admin-assets/images/logo.png" alt="Yafa Relief Logo" itemprop="logo">
                        </div>
                        <div class="news-author-detail">
                            <h3 class="mb-0" itemprop="name">Yafa Relief Team</h3>
                            <p class="mb-0">Author</p>
                        </div>
                    </div>

                    <!-- Title (IMPORTANT for SEO) -->
                    <h2 class="h2-title my-3" itemprop="headline">
                        <a href="{{ url('/our-stories/' . $story->slug) }}" class="text-decoration-none text-dark">
                            {!! $story->getHighlightedTitleAttribute() !!}
                        </a>
                    </h2>

                    <!-- Publish Date & Reading Time -->
                    <p class="news-time text-muted mb-3">
                        <time datetime="{{ $story->created_at->toDateString() }}" itemprop="datePublished">
                            {{ $story->created_at->format('F d, Y') }}
                        </time>
                        • {{ $story->getReadingTimeAttribute() ?? '3' }} min read
                    </p>

                    <!-- Featured Image -->
                    <img height="350px" src="{{ $story->thumbnail
                                    ? asset('storage/'.$story->thumbnail)
                                    : asset('/admin-assets/images/image.png') }}"
                        alt="{{ $story->title }}" class="news-content-img mb-4 object-fit-cover" itemprop="image">

                    <!-- Short Description -->
                    <p class="global-text news-description" itemprop="description">
                        {{ Str::limit($story->short_description, 150) }}
                        <a href="{{ url('/our-stories/' . $story->slug) }}">Read more</a>
                    </p>

                </article>
                @empty
                <p>No Stories Published Yet</p>
                @endforelse
            </div>
        </div>
    </section>
</x-website.layout>