<footer>
    <div class="container">
        <div class="row main-footer">
            <div class="col-lg-3 col-12">
                <img src="/src/images/footer-logo.png" alt="" class="footer-logo">
                <p class="global-text text-white footer-description my-3">Providing emergency relief, healthcare,
                    and hope to communities in crisis.</p>
                <div class="d-flex align-items-center gap-2 mt-5">
                    <a href="https://www.facebook.com/yafarelief"><img src="/src/icons/facebook.svg" alt=""></a>
                    <a href="https://www.youtube.com/@yafarelief"><img src="/src/icons/youtube.svg" alt=""></a>
                    <a href="https://x.com/yafarelief"><img src="/src/icons/twitter.svg" alt=""></a>
                    <a href="https://www.instagram.com/yafarelief/"><img src="/src/icons/instagram.svg"
                            alt=""></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 mt-lg-0 mt-md-5 mt-4 footer-border-col-1">
                <h4 class="footer-heading">Quick Links</h4>
                <ul class="mt-4 footer-list">
                    <li><a href="/"class="{{ request()->is('/') ? 'text-danger' : '' }}">Home</a></li>

                    <li><a href="/about-us" class="{{ request()->is('about-us') ? 'text-danger' : '' }}">About Us</a></li>
                    <li><a href="/contact-us"class="{{ request()->is('contact-us') ? 'text-danger' : '' }}">ContactUs</a></li>
                    <li><a href="/our-news" class="{{ request()->is('our-news*') ? 'text-danger' : '' }}">Our News</a> </li>
                    <li class="d-none"><a href="/blogs">Blogs</a></li>
                    <li><a href="{{ route('website.programs') }}"class="{{ request()->is('programs*') ? 'text-danger' : '' }}">Our Programs</a></li>
                    <li><a href="/our-blogs" class="{{ request()->is('our-blogs') ? 'text-danger' : '' }}">Our Blogs</a></li>
                    <li><a href="/get-involved" class="{{ request()->is('get-involved') ? 'text-danger' : '' }}">Get Involved</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-5 mt-lg-0 mt-md-5 mt-4 footer-border-col-2">
                <h4 class="footer-heading">Latest Programs</h4>
                <ul class="mt-4 footer-list">
                    @php
                        $footerPrograms = \App\Models\Program::where('is_active', 1)->get();
                    @endphp
                    @foreach ($footerPrograms as $program)
                        <li><a href="/programs/{{ $program->slug }}"
                                class="text-decoration-none">{{ $program->title }}</a></li>
                    @endforeach

                </ul>
            </div>


            <!-- Newsletter using the livewire component  -->


            <div class="col-lg-3 col-md-4 mt-lg-0 mt-md-5 mt-4 footer-border-col-3">
                <h4 class="footer-heading">Newsletter</h4>
                <p class="mb-0 mt-4 news-letter-desc">Subscribe today and get latest news & upcoming events.</p>
                @livewire('website.newsletter-form')
            </div>


        </div>
        <div class="d-flex justify-content-between align-items-center mt-5 footer-bottom">
            <p class="footer-copy-right mb-0">© Donit is Proudly Owned by <a href="#">HiboTheme</a></p>
            <ul class="footer-policy d-flex justify-content-end align-items-center gap-3">
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Services</a></li>
            </ul>
        </div>
    </div>
</footer>
