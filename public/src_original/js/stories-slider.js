(function () {
    'use strict';

    const slider = document.querySelector('.stories-slider');
    const track = document.querySelector('.stories-track');
    const prevBtn = document.querySelector('.stories-pervious-btn');
    const nextBtn = document.querySelector('.stories-next-btn');

    if (!slider || !track || !prevBtn || !nextBtn) return;

    const slides = track.querySelectorAll('.stories-box');
    const totalSlides = slides.length;

    let currentIndex = 0;

    function getSlideWidth() {
        const slide = slides[0];
        if (!slide) return 431; // fallback: 411px + 20px gap
        const style = getComputedStyle(track);
        const gap = parseFloat(style.gap) || 20;
        return slide.offsetWidth + gap;
    }

    function getVisibleSlides() {
        const sliderWidth = slider.offsetWidth;
        const slideWidth = getSlideWidth();
        return Math.max(1, Math.floor(sliderWidth / slideWidth));
    }

    function getMaxIndex() {
        const visible = getVisibleSlides();
        return Math.max(0, totalSlides - visible);
    }

    function updatePosition() {
        const slideWidth = getSlideWidth();
        const translateX = -currentIndex * slideWidth;
        track.style.transform = `translateX(${translateX}px)`;
        updateButtons();
    }

    function updateButtons() {
        prevBtn.disabled = currentIndex <= 0;
        nextBtn.disabled = currentIndex >= getMaxIndex();
    }

    prevBtn.addEventListener('click', function () {
        if (currentIndex > 0) {
            currentIndex--;
            updatePosition();
        }
    });

    nextBtn.addEventListener('click', function () {
        const maxIndex = getMaxIndex();
        if (currentIndex < maxIndex) {
            currentIndex++;
            updatePosition();
        }
    });

    // Initialize
    updatePosition();

    // Recalculate on resize
    let resizeTimeout;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function () {
            currentIndex = Math.min(currentIndex, getMaxIndex());
            updatePosition();
        }, 150);
    });
})();
