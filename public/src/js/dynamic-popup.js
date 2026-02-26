(function () {
    'use strict';

    var popup = document.getElementById('dynamicPopup');
    if (!popup) return;

    var popupId = popup.getAttribute('data-popup-id');
    var cooldownHours = parseInt(popup.getAttribute('data-cooldown-hours') || '6', 10);
    var storageKey = 'yafa_popup_closed_' + popupId;

    var closeBtn1 = document.getElementById('dynamicPopupClose');
    var closeBtn2 = document.getElementById('dynamicPopupClose2');
    var impactBtn = document.getElementById('dynamicPopupImpactBtn');

    function shouldShow() {
        var lastClosed = localStorage.getItem(storageKey);
        if (!lastClosed) return true;
        var elapsed = Date.now() - parseInt(lastClosed, 10);
        var cooldownMs = cooldownHours * 60 * 60 * 1000;
        return elapsed >= cooldownMs;
    }

    function markClosed() {
        localStorage.setItem(storageKey, Date.now().toString());
    }

    function openPopup() {
        popup.classList.add('is-open');
        popup.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closePopup() {
        popup.classList.remove('is-open');
        popup.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        markClosed();
    }

    // Open on load
    window.addEventListener('load', function () {
        if (!shouldShow()) return;
        setTimeout(openPopup, 800);
    });

    if (closeBtn1) closeBtn1.addEventListener('click', closePopup);
    if (closeBtn2) closeBtn2.addEventListener('click', closePopup);

    popup.addEventListener('mousedown', function (e) {
        if (e.target === popup) closePopup();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && popup.classList.contains('is-open')) closePopup();
    });

    if (impactBtn) {
        impactBtn.addEventListener('click', function () {
            markClosed();
            if (impactBtn.tagName === 'BUTTON') closePopup();
        });
    }

})();