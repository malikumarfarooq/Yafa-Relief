(function () {
    'use strict';

    // If admin has an active dynamic popup, let that one run instead
    if (document.getElementById('dynamicPopup')) return;

    var popup = document.getElementById('reminderPopup');
    if (!popup) return;

    var closeButtons = popup.querySelectorAll('[data-reminder-close]');
    var emailInput = document.getElementById('reminderEmail');
    var emailError = document.getElementById('reminderEmailError');

    function openPopup() {
        popup.classList.add('is-open');
        popup.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closePopup() {
        popup.classList.remove('is-open');
        popup.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    function isValidEmail(value) {
        return value && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
    }

    // Open after short delay on page load
    window.addEventListener('load', function () {
        setTimeout(openPopup, 800);
    });

    // Close buttons
    closeButtons.forEach(function (btn) {
        btn.addEventListener('click', closePopup);
    });

    // Click outside card
    popup.addEventListener('click', function (e) {
        if (e.target === popup) closePopup();
    });

    // Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && popup.classList.contains('is-open')) closePopup();
    });

    // Email validation (only if those elements exist in static popup)
    var form = popup.querySelector('.reminder-popup-form');
    if (form && emailInput && emailError) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            if (!isValidEmail(emailInput.value.trim())) {
                emailError.classList.add('is-visible');
                emailInput.focus();
                return;
            }
            emailError.classList.remove('is-visible');
            closePopup();
        });

        emailInput.addEventListener('input', function () {
            emailError.classList.remove('is-visible');
        });
    }

})();