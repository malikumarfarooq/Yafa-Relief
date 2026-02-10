(function () {
    'use strict';

    /* Language dropdown */
    var languageDropdown = document.querySelector('.language-dropdown');
    var languageToggle = document.getElementById('languageDropdownToggle');
    var languageMenu = document.getElementById('languageDropdownMenu');

    if (languageDropdown && languageToggle && languageMenu) {
        languageToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            languageDropdown.classList.toggle('open');
            languageToggle.setAttribute('aria-expanded', languageDropdown.classList.contains('open'));
        });

        document.addEventListener('click', function () {
            languageDropdown.classList.remove('open');
            languageToggle.setAttribute('aria-expanded', 'false');
        });

        languageMenu.addEventListener('click', function (e) {
            e.stopPropagation();
        });

        languageMenu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                languageMenu.querySelectorAll('a').forEach(function (a) { a.classList.remove('active'); });
                link.classList.add('active');
                var code = link.getAttribute('data-lang');
                var codeSpan = languageDropdown.querySelector('.language-code');
                if (codeSpan) codeSpan.textContent = code.toUpperCase();
                languageDropdown.classList.remove('open');
                languageToggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    /* Mobile menu (left slide-in) */
    var body = document.body;
    var mobileTrigger = document.getElementById('mobileMenuTrigger');
    var mobilePanel = document.getElementById('mobileMenuPanel');
    var mobileOverlay = document.getElementById('mobileMenuOverlay');
    var mobileClose = document.getElementById('mobileMenuClose');

    function openMobileMenu() {
        body.classList.add('mobile-menu-open');
        if (mobilePanel) mobilePanel.setAttribute('aria-hidden', 'false');
        if (mobileOverlay) mobileOverlay.setAttribute('aria-hidden', 'false');
        if (mobileTrigger) mobileTrigger.setAttribute('aria-expanded', 'true');
    }

    function closeMobileMenu() {
        body.classList.remove('mobile-menu-open');
        if (mobilePanel) mobilePanel.setAttribute('aria-hidden', 'true');
        if (mobileOverlay) mobileOverlay.setAttribute('aria-hidden', 'true');
        if (mobileTrigger) mobileTrigger.setAttribute('aria-expanded', 'false');
    }

    if (mobileTrigger) {
        mobileTrigger.addEventListener('click', function () {
            openMobileMenu();
        });
    }

    if (mobileClose) {
        mobileClose.addEventListener('click', closeMobileMenu);
    }

    if (mobileOverlay) {
        mobileOverlay.addEventListener('click', closeMobileMenu);
    }

    /* Close mobile menu on escape */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && body.classList.contains('mobile-menu-open')) {
            closeMobileMenu();
        }
    });
})();
