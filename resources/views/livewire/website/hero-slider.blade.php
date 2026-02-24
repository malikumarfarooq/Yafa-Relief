<div>
    @if ($slides->isNotEmpty())
        <section class="home-hero" id="heroSection"
            style="position:relative;display:flex;flex-direction:column;align-items:center;justify-content:center;">

            {{-- Background layers --}}
            @foreach ($slides as $index => $slide)
                @if ($slide->media_type === 'image')
                    <img src="{{ asset('storage/' . $slide->media_path) }}" alt="{{ $slide->title }}" class="hero-bg-layer"
                        data-index="{{ $index }}"
                        @if ($index === 0) fetchpriority="high" @else loading="lazy" @endif
                        style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;z-index:0;opacity:{{ $index === 0 ? '1' : '0' }};transition:opacity 0.8s ease;pointer-events:none;">
                @else
                    <video class="hero-bg-layer" data-index="{{ $index }}" {{ $index === 0 ? 'autoplay' : '' }}
                        muted loop playsinline @if ($index !== 0) preload="none" @endif
                        style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;z-index:0;opacity:{{ $index === 0 ? '1' : '0' }};transition:opacity 0.8s ease;pointer-events:none;">
                        <source src="{{ asset('storage/' . $slide->media_path) }}" type="video/mp4">
                    </video>
                @endif
            @endforeach

            {{-- Dark overlay --}}
            <div
                style="position:absolute;inset:0;background:linear-gradient(to right,rgba(2,13,25,0.7) 0%,rgba(2,13,25,0.2) 100%);z-index:1;pointer-events:none;">
            </div>

            {{-- Video Overlay --}}
            <div class="hero-video-overlay" id="heroVideoOverlay" aria-hidden="true">
                <video id="heroVideo" playsinline muted controls style="display:none;"></video>
                <div class="hero-video-youtube" id="heroVideoYoutube"></div>
                <button type="button" class="hero-video-close" id="heroVideoClose" aria-label="Close video">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 8L8 24M8 8L24 24" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            {{-- Slide Content --}}
            <div class="container" style="position:relative;z-index:2;">
                <div class="hero-content" id="heroContent">
                    <div class="hero-slides">
                        @foreach ($slides as $index => $slide)
                            <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"
                                data-video-src="">

                                @if ($slide->subtitle)
                                    <p class="global-text text-white mb-2"
                                        style="letter-spacing:2px;text-transform:uppercase;opacity:0.85;font-size:0.9rem;">
                                        {{ $slide->subtitle }}
                                    </p>
                                @endif

                                <h1 class="h1-title">{!! $slide->title !!}</h1>

                                <div class="d-flex align-items-center gap-3 hero-play-sec mt-4">
                                    <div>
                                        @if ($slide->description)
                                            <p class="global-text text-white">{{ $slide->description }}</p>
                                        @endif
                                        @if ($slide->button_text && $slide->button_url)
                                            <a href="{{ $slide->button_url }}"
                                                class="btn d-flex justify-content-center align-items-center gap-2 mt-3">
                                                {{ $slide->button_text }}
                                                <img src="/src/icons/btn-arrow.svg" alt="">
                                            </a>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Progress Bar Tabs — direct child of section, position:absolute from home.css works here --}}
            <div class="progressBarContainer" style="z-index:3;">
                @foreach ($slides as $index => $slide)
                    <div class="baritem {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"
                        onclick="heroGoToSlide({{ $index }})" style="cursor:pointer;">
                        <span class="progressBar">
                            <span class="inProgress inProgress{{ $index }}"></span>
                            <span class="progressText">
                                {{ strtoupper($slide->subtitle ?: $slide->title) }}
                            </span>
                        </span>
                    </div>
                @endforeach
            </div>

        </section>

        @push('scripts')
            <script>
                (function() {
                    'use strict';

                    var heroSection = document.getElementById('heroSection');
                    var heroSlides = document.querySelectorAll('#heroSection .hero-slide');
                    var bgLayers = document.querySelectorAll('#heroSection .hero-bg-layer');
                    var barItems = document.querySelectorAll('#heroSection .baritem');
                    var totalSlides = heroSlides.length;
                    var currentIndex = 0;
                    var percentTime = 0;
                    var tick = null;
                    var paused = false;
                    var time = 0.1;

                    if (!heroSection || !totalSlides) return;

                    function activateBg(index) {
                        bgLayers.forEach(function(layer, i) {
                            layer.style.opacity = (i === index) ? '1' : '0';
                        });
                        var layer = bgLayers[index];
                        if (layer && layer.tagName === 'VIDEO') {
                            layer.currentTime = 0;
                            layer.play();
                        }
                    }

                    function goToSlide(index) {
                        if (index < 0) index = totalSlides - 1;
                        if (index >= totalSlides) index = 0;

                        heroSlides[currentIndex].classList.remove('active');
                        if (barItems[currentIndex]) barItems[currentIndex].classList.remove('active');

                        currentIndex = index;

                        heroSlides[currentIndex].classList.add('active');
                        if (barItems[currentIndex]) barItems[currentIndex].classList.add('active');

                        activateBg(currentIndex);
                        startProgressbar();
                    }

                    window.heroGoToSlide = goToSlide;

                    function startProgressbar() {
                        clearInterval(tick);
                        percentTime = 0;
                        document.querySelectorAll('#heroSection .inProgress').forEach(function(el) {
                            el.style.width = '0%';
                        });
                        tick = setInterval(interval, 10);
                    }

                    function interval() {
                        if (paused) return;
                        percentTime += 1 / (time + 5);
                        document.querySelectorAll('#heroSection .inProgress' + currentIndex).forEach(function(el) {
                            el.style.width = Math.min(percentTime, 100) + '%';
                        });
                        if (percentTime >= 100) {
                            goToSlide(currentIndex + 1);
                        }
                    }

                    heroSection.addEventListener('mouseenter', function() {
                        paused = true;
                    });
                    heroSection.addEventListener('mouseleave', function() {
                        paused = false;
                    });

                    var touchStartX = 0;
                    heroSection.addEventListener('touchstart', function(e) {
                        touchStartX = e.touches[0].clientX;
                    }, {
                        passive: true
                    });
                    heroSection.addEventListener('touchend', function(e) {
                        var diff = touchStartX - e.changedTouches[0].clientX;
                        if (Math.abs(diff) > 50) {
                            goToSlide(diff > 0 ? currentIndex + 1 : currentIndex - 1);
                        }
                    }, {
                        passive: true
                    });

                    // Init
                    activateBg(0);
                    startProgressbar();

                })();
            </script>
        @endpush

    @endif
</div>
