(function () {
    'use strict';

    var overlay = document.getElementById('donationSuccessOverlay');
    var modal = document.getElementById('donationSuccessModal');
    var continueBtn = document.getElementById('cartContinueBtn');
    var closeBtn = document.getElementById('donationSuccessClose');

    if (!overlay || !modal || !continueBtn) return;

    function openPopup() {
        overlay.classList.add('is-open');
        overlay.setAttribute('aria-hidden', 'false');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closePopup() {
        overlay.classList.remove('is-open');
        overlay.setAttribute('aria-hidden', 'true');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    continueBtn.addEventListener('click', function () {
        openPopup();
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', closePopup);
    }

    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) {
            closePopup();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && overlay.classList.contains('is-open')) {
            closePopup();
        }
    });
})();
