<header>
        <div class="top-header-bar">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="top-header-contact d-flex align-items-center gap-3">
                    <a href="mailto:Info@yafarelief.org"><img src="/src/icons/mage_email.svg"
                            alt="">Info@yafarelief.org</a>
                    <a href="tel:+1 (888) 222-0160" class="ms-3"><img src="/src/icons/solar_phone-linear.svg" alt="">+1
                        (888) 222-0160</a>
                </div>
                <div class="d-flex justify-content-end align-items-center gap-3 top-header-icons">
                    <a href="https://www.facebook.com/yafarelief"><img src="/src/icons/top-facebook.svg" alt="Yafa Relief Facebook"></a>
                    <a href="https://www.youtube.com/@yafarelief"><img src="/src/icons/youtube-filled.svg" alt="Yafa Relief Youtube"></a>
                    <a href="https://x.com/yafarelief"><img src="/src/icons/top-twitter.svg" alt="Yafa Relief Twitter"></a>
                    <a href="https://www.instagram.com/yafarelief/"><img src="/src/icons/instagram-fill.svg" alt="Yafa Relief Instagram"></a>
                </div>
            </div>
        </div>
        <div class="main-header">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="header-logo">
                    <a href="/">
                        <img src="/src/images/header-logo.png" alt="" class="main-header-logo">
                    </a>
                    <button type="button" class="mobile-menu-trigger" id="mobileMenuTrigger" aria-label="Open menu"
                        aria-expanded="false">
                        <img src="/src/images/menubar.png" alt="">
                    </button>
                </div>
                <div class="header-menu">
                    <ul class="p-0 m-0">
                        {{-- <li><a href="/" class="{{  request()->is('/') ? 'text-danger' : '' }}">Home</a></li> --}}
                        <li><a href="/about-us" class="{{ request()->is('/about-us') ? 'text-danger' : '' }}">About Us</a></li>
                        <li><a href="/our-news" class="{{  request()->is('our-news*') ? 'text-danger' : '' }}">Our News</a></li>
                        <li ><a href="/our-blogs"   class="{{  request()->is('our-blogs') ?  'text-danger' : ''}}">Blogs</a></li>

                        <li><a href="{{ route('website.programs') }}" class="{{  request()->is('programs*') ? 'text-danger' : '' }}">Our Programs</a></li>
                        <li><a href="our-policies" class="{{ request()->is('our-policies') ? 'text-danger' :''}}">Our Policies</a></li>
                        <li ><a href="/donate"  class="{{ request()->is('donate') ? 'text-danger' : '' }}">Donate</a></li>
                        <li ><a href="/contact-us" class="{{ request()->is('/contact-us') ? 'text-danger' : '' }}">Contact Us</a></li>
                    </ul>
                    <a href="/"><img src="/src/images/header-logo.png" alt="" class="mobile-header-logo"></a>
                </div>
                <div class="header-btns d-flex justify-content-end align-items-center gap-3">
                    <div class="language-dropdown">
                        <button class="language-dropdown-toggle" type="button" aria-expanded="false"
                            aria-haspopup="true" id="languageDropdownToggle">
                            <img src="/src/icons/english-flag.svg" alt="" class="language-flag-icon">
                            <span class="language-code">EN</span>
                            <svg class="language-caret" width="10" height="6" viewBox="0 0 10 6" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                        <ul class="language-dropdown-menu" id="languageDropdownMenu">
                            <li><a href="#" data-lang="en" class="active">English</a></li>
                            <li><a href="#" data-lang="ar">العربية</a></li>
                            <li><a href="#" data-lang="ur">اردو</a></li>
                        </ul>
                    </div>
                    <livewire:website.cart-count />
                    <a id="headerDonateBtn" href="/programs"
                        class="donate d-flex align-items-center justify-content-center gap-2 text-decoration-none">Donate <img
                            src="/src/icons/header-arrow.svg" alt=""></a>
                </div>
            </div>
        </div>
        <div class="mobile-menu-overlay" id="mobileMenuOverlay" aria-hidden="true"></div>
        <div class="mobile-menu-panel" id="mobileMenuPanel" aria-hidden="true">
            <div class="mobile-menu-panel-inner">
                <div>
                    <img src="/src/images/header-logo.png" alt="" class="menu-logo">
                    <button type="button" class="mobile-menu-close" id="mobileMenuClose" aria-label="Close menu">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 7L7 21M7 7L21 21" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <nav class="mobile-menu-nav">
                    <ul>
                        <li><a href="/" class="{{  request()->is('/') ? 'text-danger' : '' }}>Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="/our-news" class="{{  request()->is('our-news*') ? 'text-danger' : '' }}">Our News</a></li>
                        <li ><a href="/blogs">Blogs</a></li>
                        <li><a href="{{ route('website.programs') }}" class="{{  request()->is('programs*') ? 'text-danger' : '' }}">Our Programs</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
