(function () {
    'use strict';

    var popup = document.getElementById('donationPopup');
    var openBtn = document.getElementById('headerDonateBtn');
    if (!popup || !openBtn) return;

    var closeButtons = popup.querySelectorAll('[data-donation-close]');
    var freqButtons = popup.querySelectorAll('.donation-toggle-btn[data-frequency]');
    var amountItems = popup.querySelectorAll('.donation-amount-item[data-amount]');
    var customAmountInput = popup.querySelector('.donation-other-input[data-custom-amount]');

    function openPopup() {
        popup.classList.add('is-open');
        popup.setAttribute('aria-hidden', 'false');
    }

    function closePopup() {
        popup.classList.remove('is-open');
        popup.setAttribute('aria-hidden', 'true');
    }

    // Open from header Donate button
    openBtn.addEventListener('click', function () {
        openPopup();
    });

    // Close buttons
    closeButtons.forEach(function (btn) {
        btn.addEventListener('click', closePopup);
    });

    // Close when clicking backdrop
    popup.addEventListener('click', function (event) {
        if (event.target === popup) {
            closePopup();
        }
    });

    // Toggle frequency (Give Once / Monthly)
    freqButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            freqButtons.forEach(function (b) {
                b.classList.remove('is-active');
            });
            btn.classList.add('is-active');
        });
    });

    // Select preset amount
    amountItems.forEach(function (item) {
        item.addEventListener('click', function () {
            amountItems.forEach(function (el) {
                el.classList.remove('is-active');
            });
            item.classList.add('is-active');
            if (customAmountInput) {
                customAmountInput.value = '';
            }
        });
    });

    // When user types custom amount, deselect preset options
    if (customAmountInput) {
        customAmountInput.addEventListener('input', function () {
            if (customAmountInput.value.trim() !== '') {
                amountItems.forEach(function (el) {
                    el.classList.remove('is-active');
                });
            }
        });
    }
})();

