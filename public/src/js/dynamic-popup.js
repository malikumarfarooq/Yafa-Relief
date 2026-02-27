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

    // ── Cooldown ──────────────────────────────────────────────

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

    // ── Open / Close ──────────────────────────────────────────

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

    // ── Init ──────────────────────────────────────────────────

    window.addEventListener('load', function () {
        if (!shouldShow()) return;
        setTimeout(openPopup, 800);
    });

    // ── Listeners ─────────────────────────────────────────────

    if (closeBtn1) closeBtn1.addEventListener('click', closePopup);
    if (closeBtn2) closeBtn2.addEventListener('click', closePopup);

    // Click outside card closes popup
    popup.addEventListener('mousedown', function (e) {
        if (e.target === popup) closePopup();
    });

    // Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && popup.classList.contains('is-open')) closePopup();
    });

    // Make an Impact button
    if (impactBtn) {
        impactBtn.addEventListener('click', function () {
            markClosed();
            if (impactBtn.tagName === 'BUTTON') closePopup();
            // <a> tag navigates naturally
        });
    }

})();