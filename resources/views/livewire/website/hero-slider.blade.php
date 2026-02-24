<div>
    @if ($slides->isNotEmpty())
        <section class="home-hero" id="heroSection">

            {{-- Background layers --}}
            @foreach ($slides as $index => $slide)
                @if ($slide->media_type === 'image')
                    <img src="{{ asset('storage/' . $slide->media_path) }}" alt="{{ $slide->title }}" class="hero-bg-layer"
                        data-index="{{ $index }}"
                        @if ($index === 0) fetchpriority="high" @else loading="lazy" @endif
                        style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center; z-index:0; opacity:{{ $index === 0 ? '1' : '0' }}; transition:opacity 1s ease;">
                @else
                    <video class="hero-bg-layer" data-index="{{ $index }}" muted loop playsinline
                        @if ($index === 0) autoplay @else preload="none" @endif
                        style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center; z-index:0; opacity:{{ $index === 0 ? '1' : '0' }}; transition:opacity 1s ease;">
                        <source src="{{ asset('storage/' . $slide->media_path) }}" type="video/mp4">
                    </video>
                @endif
            @endforeach

            {{-- Dark overlay --}}
            <div class="hero-overlay"></div>

            {{-- Slide contents --}}
            <div class="container hero-container">
                <div class="hero-content-wrapper">
                    @foreach ($slides as $index => $slide)
                        <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}">
                            @if ($slide->subtitle)
                                <div class="slider-maintitle">{{ strtoupper($slide->subtitle) }}</div>
                            @endif
                            <h1 class="slider-title">{!! $slide->title !!}</h1>
                            @if ($slide->description || $slide->button_text)
                                <div class="hero-slide-footer mt-4 mt-md-5">
                                    @if ($slide->description)
                                        <p class="global-text text-white mb-4">{{ $slide->description }}</p>
                                    @endif
                                    @if ($slide->button_text && $slide->button_url)
                                        <a href="{{ $slide->button_url }}"
                                            class="silder-btn d-inline-flex align-items-center gap-2">
                                            {{ $slide->button_text }}
                                            <img src="/src/icons/btn-arrow.svg" alt="→" width="20">
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Progress bars --}}
            <div class="progressBarContainer">
                @foreach ($slides as $index => $slide)
                    <div class="baritem {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"
                        onclick="heroGoToSlide({{ $index }})">
                        <span class="progressBar">
                            <span class="inProgress inProgress{{ $index }}"></span>
                        </span>
                        <span class="progressText">
                            {{ strtoupper($slide->subtitle ?: substr($slide->title, 0, 30) . (strlen($slide->title) > 30 ? '…' : '')) }}
                        </span>
                    </div>
                @endforeach
            </div>

        </section>

        @push('styles')
            <style>
                .home-hero {
                    position: relative;
                    height: 100vh;
                    min-height: 680px;
                    overflow: hidden;
                    display: flex;
                    flex-direction: column;
                }

                .hero-overlay {
                    position: absolute;
                    inset: 0;
                    background: linear-gradient(to right, rgba(2, 13, 25, 0.65) 0%, rgba(2, 13, 25, 0.25) 100%);
                    z-index: 1;
                    pointer-events: none;
                }

                .hero-container {
                    position: relative;
                    z-index: 2;
                    height: 100%;
                    display: flex;
                    align-items: center;
                }

                .hero-content-wrapper {
                    max-width: 1300px;
                    width: 100%;
                    margin: 0 auto;
                    padding: 0 1rem;
                    color: white;
                }

                .slider-maintitle {
                    font-size: 1.1rem;
                    letter-spacing: 1.5px;
                    text-transform: uppercase;
                    opacity: 0.9;
                    margin-bottom: 0.5rem;
                }

                .slider-title {
                    font-size: clamp(2.8rem, 8vw, 5.5rem);
                    font-weight: 400;
                    line-height: 1.05;
                    margin-bottom: 1rem;
                }

                .silder-btn {
                    background: #43A047;
                    color: white;
                    padding: 0.8rem 1.8rem;
                    border-radius: 50px;
                    font-size: 1.1rem;
                    font-weight: 500;
                    text-decoration: none;
                    transition: all 0.25s;
                }

                .silder-btn:hover {
                    background: #3a8f3e;
                    transform: translateY(-2px);
                }

                .progressBarContainer {
                    position: absolute;
                    bottom: 3rem;
                    left: 0;
                    right: 0;
                    z-index: 3;
                    display: flex;
                    justify-content: center;
                    gap: 1.2rem;
                    padding: 0 1.5rem;
                    flex-wrap: wrap;
                }

                .baritem {
                    cursor: pointer;
                    flex: 1 1 180px;
                    max-width: 280px;
                    min-width: 110px;
                    text-align: center;
                }

                .progressBar {
                    display: block;
                    height: 4px;
                    background: rgba(255, 255, 255, 0.28);
                    border-radius: 4px;
                    overflow: hidden;
                    margin-bottom: 0.7rem;
                }

                .inProgress {
                    width: 0%;
                    height: 100%;
                    background: #ffffff;
                    display: block;
                    transition: width 0.12s linear;
                }

                .progressText {
                    color: white;
                    font-size: clamp(0.9rem, 2.2vw, 1.15rem);
                    font-weight: 500;
                    text-transform: uppercase;
                    letter-spacing: 0.6px;
                    opacity: 0.92;
                }

                .baritem.active .progressText {
                    opacity: 1;
                    font-weight: 600;
                }

                @media (max-width: 992px) {
                    .progressBarContainer {
                        bottom: 2rem;
                        gap: 0.9rem;
                    }

                    .baritem {
                        flex: 1 1 140px;
                        max-width: 220px;
                    }
                }

                @media (max-width: 576px) {
                    .home-hero {
                        min-height: 85vh;
                    }

                    .progressBarContainer {
                        bottom: 1.5rem;
                        padding: 0 1rem;
                    }

                    .baritem:not(.active) {
                        display: none;
                    }

                    .baritem {
                        flex: 1 1 auto;
                        max-width: 380px;
                        min-width: 0;
                    }

                    .slider-title {
                        font-size: clamp(2.2rem, 9vw, 3.6rem);
                    }

                    .silder-btn {
                        padding: 0.7rem 1.5rem;
                        font-size: 1rem;
                    }
                }
            </style>
        @endpush

        @push('scripts')
            <script>
                (function() {
                    'use strict';

                    const section = document.getElementById('heroSection');
                    if (!section) return;

                    const slides = section.querySelectorAll('.hero-slide');
                    const bgs = section.querySelectorAll('.hero-bg-layer');
                    const bars = section.querySelectorAll('.baritem');
                    const total = slides.length;

                    let current = 0;
                    let timer = null;
                    let paused = false;
                    const duration = 6500; // ms
                    const step = 100 / (duration / 10);

                    function activate(index) {
                        slides.forEach((s, i) => s.classList.toggle('active', i === index));
                        bgs.forEach((bg, i) => {
                            bg.style.opacity = (i === index) ? '1' : '0';
                            if (bg.tagName === 'VIDEO') {
                                if (i === index) {
                                    bg.currentTime = 0;
                                    bg.play().catch(() => null);
                                } else {
                                    bg.pause();
                                }
                            }
                        });
                        bars.forEach((b, i) => b.classList.toggle('active', i === index));
                    }

                    function resetBars() {
                        document.querySelectorAll('.inProgress').forEach(el => el.style.width = '0%');
                    }

                    function runProgress() {
                        clearInterval(timer);
                        resetBars();
                        let progress = 0;

                        timer = setInterval(() => {
                            if (paused) return;
                            progress += step;
                            const bar = document.querySelector(`.inProgress${current}`);
                            if (bar) bar.style.width = Math.min(progress, 100) + '%';

                            if (progress >= 100) {
                                current = (current + 1) % total;
                                activate(current);
                                runProgress();
                            }
                        }, 10);
                    }

                    window.heroGoToSlide = function(idx) {
                        if (idx < 0 || idx >= total) return;
                        current = idx;
                        activate(current);
                        runProgress();
                    };

                    // Hover pause
                    section.addEventListener('mouseenter', () => paused = true);
                    section.addEventListener('mouseleave', () => paused = false);

                    // Touch swipe
                    let touchStartX = 0;
                    section.addEventListener('touchstart', e => {
                        touchStartX = e.touches[0].clientX;
                    }, {
                        passive: true
                    });

                    section.addEventListener('touchend', e => {
                        let diff = touchStartX - e.changedTouches[0].clientX;
                        if (Math.abs(diff) > 60) {
                            let next = diff > 0 ? current + 1 : current - 1;
                            heroGoToSlide(next % total);
                        }
                    }, {
                        passive: true
                    });

                    // Start
                    activate(0);
                    runProgress();

                })();
            </script>
        @endpush
    @endif
</div>
