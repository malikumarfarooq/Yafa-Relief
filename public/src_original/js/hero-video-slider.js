(function () {
    'use strict';

    var heroSection = document.querySelector('.home-hero');
    var heroContent = document.getElementById('heroContent');
    var heroVideoOverlay = document.getElementById('heroVideoOverlay');
    var heroVideo = document.getElementById('heroVideo');
    var heroVideoYoutube = document.getElementById('heroVideoYoutube');
    var heroVideoClose = document.getElementById('heroVideoClose');
    var heroPlayBtns = document.querySelectorAll('.hero-play-btn');
    var heroSliderPrev = document.getElementById('heroSliderPrev');
    var heroSliderNext = document.getElementById('heroSliderNext');
    var heroSlides = document.querySelectorAll('.hero-slide');

    if (!heroSection || !heroVideoOverlay || !heroVideo || !heroSlides.length) return;

    var currentSlideIndex = 0;
    var totalSlides = heroSlides.length;

    function getActiveSlide() {
        return document.querySelector('.hero-slide.active');
    }

    function getYoutubeVideoId(url) {
        if (!url) return null;
        var id = null;
        if (url.indexOf('youtube.com/watch') !== -1) {
            var match = url.match(/[?&]v=([^&]+)/);
            id = match ? match[1] : null;
        } else if (url.indexOf('youtu.be/') !== -1) {
            var parts = url.split('youtu.be/');
            id = parts[1] ? parts[1].split(/[?&#]/)[0] : null;
        }
        return id;
    }

    function isYoutubeUrl(url) {
        return url && (url.indexOf('youtube.com') !== -1 || url.indexOf('youtu.be') !== -1);
    }

    function showVideo() {
        var activeSlide = getActiveSlide();
        var videoSrc = activeSlide && activeSlide.getAttribute('data-video-src');
        if (!videoSrc) return;

        heroVideoOverlay.setAttribute('aria-hidden', 'false');
        heroVideoOverlay.classList.add('is-active');
        heroSection.classList.add('hero-video-playing');

        if (isYoutubeUrl(videoSrc)) {
            var videoId = getYoutubeVideoId(videoSrc);
            if (videoId) {
                heroVideo.style.display = 'none';
                heroVideoYoutube.style.display = 'block';
                heroVideoYoutube.innerHTML = '<iframe src="https://www.youtube.com/embed/' + videoId + '?autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            }
        } else {
            heroVideoYoutube.style.display = 'none';
            heroVideoYoutube.innerHTML = '';
            heroVideo.style.display = 'block';
            heroVideo.src = videoSrc;
            heroVideo.play().catch(function () {});
        }
    }

    function hideVideo() {
        heroVideo.pause();
        heroVideo.removeAttribute('src');
        heroVideo.load();
        heroVideo.style.display = 'none';
        heroVideoYoutube.style.display = 'none';
        heroVideoYoutube.innerHTML = '';
        heroVideoOverlay.classList.remove('is-active');
        heroVideoOverlay.setAttribute('aria-hidden', 'true');
        heroSection.classList.remove('hero-video-playing');
    }

    function goToSlide(index) {
        hideVideo(); /* reset: close video overlay when slide changes */
        if (index < 0) index = totalSlides - 1;
        if (index >= totalSlides) index = 0;
        currentSlideIndex = index;
        heroSlides.forEach(function (slide, i) {
            slide.classList.toggle('active', i === currentSlideIndex);
        });
    }

    function nextSlide() {
        goToSlide(currentSlideIndex + 1);
    }

    function prevSlide() {
        goToSlide(currentSlideIndex - 1);
    }

    // Play button(s) – any hero play btn in any slide
    heroPlayBtns.forEach(function (btn) {
        btn.addEventListener('click', showVideo);
        btn.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                showVideo();
            }
        });
    });

    // Close video (button + when video ends)
    if (heroVideoClose) {
        heroVideoClose.addEventListener('click', hideVideo);
    }
    heroVideo.addEventListener('ended', hideVideo);

    // Next / Previous slide
    if (heroSliderNext) {
        heroSliderNext.addEventListener('click', nextSlide);
    }
    if (heroSliderPrev) {
        heroSliderPrev.addEventListener('click', prevSlide);
    }

    // Initial slide
    goToSlide(0);
})();
