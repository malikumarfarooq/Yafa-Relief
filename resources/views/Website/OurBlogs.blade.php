<x-website.layout metaTitle="Our Blogs"
    metaDescription="Explore insightful blogs, articles, and thought leadership from Yafa Relief. Gain perspectives on land rights, community empowerment, generational wealth protection, and humanitarian efforts."
    metaKeywords="Yafa Relief blogs, land rights articles, community empowerment, BIPOC insights, humanitarian blogs, generational wealth protection">
    <section class="global-hero-section news-hero-sec d-flex justify-content-center flex-column">
        <div class="container">
            <img src="/src/icons/global-hero-heart.svg" alt="">
            <h1>Our Blogs <span>& Insights</span></h1>
            <p class="global-text text-white">
                Dive into thoughtful articles, expert perspectives, and updates from Yafa Relief. 
                Learn about land ownership challenges, community success stories, empowerment strategies, 
                and the work being done to support families and protect generational wealth.
            </p>
        </div>
    </section>

    <section class="news-content-section">
        <div class="container">
            <div class="row justify-content-between">
                @forelse ($blogs as $blog)
                <article class="col-lg-6 mb-5" itemscope itemtype="https://schema.org/BlogPosting">

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
                        <a href="{{ url('/our-blogs/' . $blog->slug) }}" class="text-decoration-none text-dark">
                            {!! $blog->getHighlightedTitleAttribute() !!}
                        </a>
                    </h2>

                    <!-- Publish Date -->
                    <p class="news-time text-muted mb-3">
                        <time datetime="{{ $blog->created_at->toDateString() }}" itemprop="datePublished">
                            {{ $blog->created_at->format('F d, Y') }}
                        </time>
                        • {{ $blog->getReadingTimeAttribute() }} min read
                    </p>

                    <!-- Featured Image -->
                    <img height="350px" src="{{ $blog->thumbnail
                                    ? asset('storage/'.$blog->thumbnail)
                                    : asset('/admin-assets/images/image.png') }}"
                        alt="{{ $blog->title }}" class="news-content-img mb-4 object-fit-cover" itemprop="image">

                    <!-- Short Description -->
                    <p class="global-text news-description" itemprop="description">
                        {{ Str::limit($blog->short_description, 150) }}
                        <a href="{{ url('/our-blogs/' . $blog->slug) }}">Read more</a>
                    </p>

                </article>
                @empty
                <p>No Blogs Published Yet</p>
                @endforelse

            </div>
        </div>
    </section>
</x-website.layout>