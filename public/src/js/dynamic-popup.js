(function () {
    'use strict';

    // ── Get popup element ─────────────────────────────────────
    var popup = document.getElementById('dynamicPopup');
    if (!popup) return; // No active popup in DB — do nothing

    var popupId = popup.getAttribute('data-popup-id');
    var cooldownHours = parseInt(popup.getAttribute('data-cooldown-hours') || '6', 10);
    var storageKey = 'yafa_popup_seen_' + popupId;

    // ── Buttons ───────────────────────────────────────────────
    var closeBtn = document.getElementById('dynamicPopupClose');
    var noThanksBtn = document.getElementById('dynamicPopupNoThanks');
    var impactBtn = document.getElementById('dynamicPopupImpactBtn');

    // ── Cooldown Logic (localStorage) ─────────────────────────
    function shouldShow() {
        try {
            var lastSeen = localStorage.getItem(storageKey);
            if (!lastSeen) return true;
            var elapsed = Date.now() - parseInt(lastSeen, 10);
            var cooldownMs = cooldownHours * 60 * 60 * 1000;
            return elapsed >= cooldownMs;
        } catch (e) {
            return true; // if localStorage blocked, always show
        }
    }

    function markSeen() {
        try {
            localStorage.setItem(storageKey, Date.now().toString());
        } catch (e) {
            // silent fail
        }
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
        markSeen();
    }

    // ── Init: show after 800ms delay ─────────────────────────
    window.addEventListener('load', function () {
        if (!shouldShow()) return;
        setTimeout(openPopup, 800);
    });

    // ── Close handlers ────────────────────────────────────────
    if (closeBtn) closeBtn.addEventListener('click', closePopup);
    if (noThanksBtn) noThanksBtn.addEventListener('click', closePopup);

    // Click outside popup card closes it
    popup.addEventListener('mousedown', function (e) {
        if (e.target === popup) closePopup();
    });

    // Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && popup.classList.contains('is-open')) {
            closePopup();
        }
    });

    // Make an Impact button — mark seen then let link navigate
    if (impactBtn) {
        impactBtn.addEventListener('click', function () {
            markSeen();
            // If it's a <button> (no redirect_url), close popup
            if (impactBtn.tagName === 'BUTTON') {
                closePopup();
            }
            // If it's an <a>, browser navigates naturally
        });
    }

})();