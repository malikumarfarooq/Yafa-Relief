<x-website.layout metaTitle="{{ $program->title }}"
    metaDescription="Discover the details of our impactful programs at Auntie Legacy, where we work tirelessly to help Black, Indigenous, and People of Color (BIPOC) retain their land and property ownership across the United States. Join us in our mission to protect generational wealth and support families in need."
    metaKeywords="Auntie Legacy program details, BIPOC land ownership program details, non-profit organization program details, property retention program details, generational wealth program details, legal support program details, community empowerment program details">

    <section
        class="global-hero-section program-detail-hero-sec d-flex justify-content-center flex-column position-relative"
        style="background: url('{{ $program->thumbnail ? asset('/storage/'.$program->cover_image) : asset('/src/images/our-program.webp') }}') center / cover no-repeat !important;">
        <div class="container">
            <ul class="p-0 m-0 blog-breadcrum d-flex align-items-center">
                <li class="text-warning">{{ $program->getCategoriesStringAttribute()
                                }}</li>
            </ul>
            <h1>{{ $program->title }}</h1>
            <p class="global-text text-white">
                {{ $program->short_description }}
            </p>
        </div>
        <livewire:website.add-to-cart :program="$program" />
    </section>
    <section class="program-overview-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="section-badge">PROGRAM OVERVIEW</h5>
                    <h2 class="h2-title">Nourishing Our <span>Community</span></h2>
                    <p class="global-text">
                        {!! nl2br(e($program->description)) !!}
                    </p>

                </div>
                <div class="col-lg-6 mt-lg-0 mt-5 pt-lg-0 pt-4">
                    <div class="row">
                        @foreach($program->getAttributesArrayAttribute() as $attribute)
                        <div class="col-md-6 mb-5">
                            <div class="program-overview-box">
                                <img src="/src/images/program-overview-1.png" alt="">
                                <h3>{{$attribute->name}}</h3>
                                <p class="global-text">
                                    {{ $attribute->description }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                        
                        <div class="col-md-12">
                            <div class="afford-meal-box d-flex justify-content-between align-items-center">
                                <div class="meal-content">
                                    <h3>Legacy Message</h3>
                                    <p class="global-text">{{ $program->legacy_message }}</p>
                                </div>
                                <div class="meal-img">
                                    <img src="/src/images/meal-donate.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h3 class="h3-title my-3 mt-5">Our Promises</h3>
                            <ul class="promises-list">
                                @foreach ($program->promises as $promise)
                                <li>{{ $promise }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="WWD-section">
        <div class="container">
            <h5 class="section-badge text-center">WHAT WE DO</h5>
            <h2 class="h2-title text-center m-auto">How we support communities with <span>care and dignity</span></h2>
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="wwd-box">
                        <img src="/src/images/wwd-img.webp" alt="">
                        <h3 class="h3-title mt-4">Food Distribution</h3>
                        <p class="global-text">
                            We distribute essential food parcels to families facing hunger and financial hardship.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="wwd-box">
                        <img src="/src/images/wwd-img.webp" alt="">
                        <h3 class="h3-title mt-4">Food Distribution</h3>
                        <p class="global-text">
                            We distribute essential food parcels to families facing hunger and financial hardship.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="wwd-box">
                        <img src="/src/images/wwd-img.webp" alt="">
                        <h3 class="h3-title mt-4">Food Distribution</h3>
                        <p class="global-text">
                            We distribute essential food parcels to families facing hunger and financial hardship.
                        </p>
                    </div>
                </div>
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
                    <img src="/src/images/about-core-value.webp" alt="" class="core-values-img">
                </div>
            </div>
        </div>
    </section>
    @if($program->media()->count() > 0)
    <section class="work-gallery-section">
        <div class="container">
            <h5 class="section-badge text-center">WORK GALLERY</h5>
            <h2 class="h2-title text-center">Turning Hope <span>Into Action</span></h2>
            <div class="row mt-5 gallery-boxes">
                @foreach($program->media as $media)
                <div class="col-md-4">
                    <img src="{{ asset('storage/'.$media->url) }}" alt="" class="gallery-img">
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <section class="related-program-section">
        <div class="container">
            <h5 class="section-badge text-center">RELATED PROGRAMS</h5>
            <h2 class="h2-title text-capitalize text-center">Providing hope where it’s <span>needed most</span></h2>
            <p class="global-text text-center">
                Together, we support vulnerable communities with care and compassion. Delivering meaningful action that
                creates lasting impact for generations.
            </p>
            <div class="row mt-5 program-boxes">
                @foreach ($randomPrograms as $program )
                <div class="col-md-6">
                    <div class="program-box p-4"
                        style="background: url('{{ $program->thumbnail ? asset('/storage/'.$program->thumbnail) : asset('/src/images/our-program.webp') }}') center / cover no-repeat !important;">
                        <div class="program-box-inner">
                            <div class="category-tag h6 mt-3 text-warning">{{ $program->getCategoriesStringAttribute()
                                }}</div>
                            <h3 class="h3-title mb-3 mt-3">{{ $program->title }}</h3>
                            <div class="d-lg-flex justify-content-between align-items-center">
                                <p class="global-text text-white h6">
                                    {{ $program->short_description }}
                                </p>
                                <a href="{{ route('website.program-details', $program->slug) }}"
                                    class="btn d-flex align-items-center ms-3 px-3">Donate Now <img
                                        src="/src/icons/btn-arrow.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="program-donate-section">
        <div class="container">
            <div class="program-donate-box">
                <div class="row">
                    <div class="col-lg-7">
                        <h5 class="section-badge">YOUR DONATIONS MATTERS</h5>
                        <h2 class="h2-title">How You Can Make a Difference</h2>
                        <p class="global-text">
                            Your support helps us reach more families and restore hope. Every donation or volunteer
                            effort makes a real difference in someone's life.
                        </p>
                        <div class="d-flex align-items-center gap-3 mt-4 meals-btns">
                            <a href="#" class="btn d-flex justify-content-center align-items-center gap-2">Donate Now
                                <img src="/src/icons/btn-arrow.svg" alt=""></a>
                            <a href="#" class="btn d-flex justify-content-center align-items-center volunter-btn">Become
                                a Volunteer <img src="/src/icons/btn-arrow-black.svg" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-5 mt-lg-0 mt-md-5">
                        <div class="program-donate-box-img">
                            <img src="/src/images/volunter-box-2.webp" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-website.layout>
@push('script')
<script>
    // Donation frequency toggle
        const frequencyButtons = document.querySelectorAll('.donation-frequency-btn');
        frequencyButtons.forEach(button => {
            button.addEventListener('click', function() {
                frequencyButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Donation amount selection
        const amountButtons = document.querySelectorAll('.donation-amount-btn');
        amountButtons.forEach(button => {
            button.addEventListener('click', function() {
                amountButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });
</script>
@endpush