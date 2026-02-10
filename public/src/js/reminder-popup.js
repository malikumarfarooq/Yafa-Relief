(function () {
    'use strict';

    var popup = document.getElementById('reminderPopup');
    if (!popup) return;

    var closeButtons = popup.querySelectorAll('[data-reminder-close]');
    var form = popup.querySelector('.reminder-popup-form');
    var emailInput = document.getElementById('reminderEmail');
    var emailError = document.getElementById('reminderEmailError');

    function openPopup() {
        popup.classList.add('is-open');
        popup.setAttribute('aria-hidden', 'false');
    }

    function closePopup() {
        popup.classList.remove('is-open');
        popup.setAttribute('aria-hidden', 'true');
    }

    function isValidEmail(value) {
        if (!value) return false;
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
    }

    // Open on initial page load (after a short delay for a smoother UX)
    window.addEventListener('load', function () {
        setTimeout(openPopup, 800);
    });

    // Close handlers
    closeButtons.forEach(function (btn) {
        btn.addEventListener('click', closePopup);
    });

    // Optional: close when clicking outside the card
    popup.addEventListener('click', function (event) {
        if (event.target === popup) {
            closePopup();
        }
    });

    // Basic email validation on submit
    if (form && emailInput && emailError) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            var value = emailInput.value.trim();
            if (!isValidEmail(value)) {
                emailError.classList.add('is-visible');
                emailInput.focus();
                return;
            }

            // Here you can integrate with your backend or email service
            // For now we just close the popup on a valid email
            emailError.classList.remove('is-visible');
            closePopup();
        });

        emailInput.addEventListener('input', function () {
            if (emailError.classList.contains('is-visible')) {
                emailError.classList.remove('is-visible');
            }
        });
    }
})();

