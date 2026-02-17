<x-website.layout metaTitle="Our News"
    metaDescription="Welcome to Auntie Legacy, a non-profit organization dedicated to helping Black, Indigenous, and People of Color (BIPOC) retain their land and property ownership across the United States. Join us in our mission to protect generational wealth and support families in need."
    metaKeywords="Auntie Legacy, BIPOC land ownership, non-profit organization, property retention, generational wealth, legal support, community empowerment">
    <section class="global-hero-section news-hero-sec d-flex justify-content-center flex-column">
        <div class="container">
            <img src="/src/icons/global-hero-heart.svg" alt="">
            <h1>Latest News <span>& Updates</span></h1>
            <p class="global-text text-white">
                Stay updated with Yafa Relief’s latest activities, emergency responses, and humanitarian efforts. From
                life-saving aid distributions to community support initiatives, this is where impact meets transparency.
            </p>
        </div>
    </section>

    <section class="news-content-section">
        <div class="container">
            <div class="row justify-content-between">
                @forelse ($news as $new)
                <article class="col-lg-6 mb-5" itemscope itemtype="https://schema.org/NewsArticle">

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
                        <a href="{{ url('/our-news/' . $new->slug) }}" class="text-decoration-none text-dark">
                            {!! $new->getHighlightedTitleAttribute() !!}
                        </a>
                    </h2>

                    <!-- Publish Date -->
                    <p class="news-time text-muted mb-3">
                        <time datetime="{{ $new->created_at->toDateString() }}" itemprop="datePublished">
                            {{ $new->created_at->format('F d, Y') }}
                        </time>
                        • {{ $new->getReadingTimeAttribute() }} min read
                    </p>

                    <!-- Featured Image -->
                    <img height="350px" src="{{ $new->thumbnail
                                    ? asset('storage/'.$new->thumbnail)
                                    : asset('/admin-assets/images/image.png') }}"
                        alt="{{ $new->title }}" class="news-content-img mb-4 object-fit-cover" itemprop="image">

                    <!-- Short Description -->
                    <p class="global-text news-description" itemprop="description">
                        {{ Str::limit($new->short_description, 150) }}
                        <a href="{{ url('/our-news/' . $new->slug) }}">Read more</a>
                    </p>

                </article>
                @empty
                <p>No News Updates Published</p>
                @endforelse

            </div>
        </div>
    </section>


</x-website.layout>