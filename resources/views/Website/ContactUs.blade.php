<x-website.layout metaTitle="Contact Us" metaDescription="Contact Yafa Relief">

    <section class="global-hero-section contact-hero-sec d-flex justify-content-center flex-column">
        <div class="container">
            <img src="/src/icons/global-hero-heart.svg" alt="">
            <h1>Contact <span>Us</span></h1>
            <p class="global-text text-white">
                We're here to listen, support, and guide you. Reach out to us with your questions, ideas, or partnership
                inquiries — our team will be happy to connect with you.
            </p>
        </div>
    </section>

    <section class="contact-form-section">
        <div class="container">
            <div class="row">
                {{-- Left Side -- Contact Info --}}
                <div class="col-lg-6">
                    <h5 class="section-badge">CONTACT US</h5>
                    <h2 class="h2-title">Get in Touch <span>With Us</span></h2>
                    <p class="global-text">Have questions, feedback, or need assistance? We'd love to hear from you.</p>
                    <div class="d-flex align-items-center gap-3 mt-5">
                        <div class="contact-img"><img src="/src/images/map.png" alt=""></div>
                        <div class="contact-detail">
                            <h3>Address</h3>
                            <a>110 Carlton Blvd Ridgeland, Mississippi 39157</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 mt-4">
                        <div class="contact-img"><img src="/src/images/mail.png" alt=""></div>
                        <div class="contact-detail">
                            <h3>Email</h3>
                            <a href="mailto:Info@Yafarelief.org">Info@Yafarelief.org</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 mt-4">
                        <div class="contact-img"><img src="/src/images/phone.png" alt=""></div>
                        <div class="contact-detail">
                            <h3>Phone</h3>
                            <a href="tel:+18882220160">+1 (888) 222-0160</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 mt-4">
                        <div class="contact-img"><img src="/src/images/clock.png" alt=""></div>
                        <div class="contact-detail">
                            <h3>Office Hours</h3>
                            <a>Monday-Friday: 9:00 AM - 5:00 PM EST</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 mt-5 contact-social-links">
                        <a href="#"><img src="/src/icons/contact-facebook.svg" alt=""></a>
                        <a href="#"><img src="/src/icons/contact-youtube.svg" alt=""></a>
                        <a href="#"><img src="/src/icons/contact-twitter.svg" alt=""></a>
                        <a href="#"><img src="/src/icons/contact-insta.svg" alt=""></a>
                    </div>
                </div>

                {{-- Right Side -- Livewire Form --}}
                <div class="col-lg-6 mt-lg-0 mt-5">
                    <div class="contact-form-box">
                        <h3>Contact Information</h3>
                        @livewire('website.contact-form')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="map-section">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d105444.30760212595!2d-87.75588326018197!3d41.89841436663521!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880fd36b093a9a07%3A0x940cc06f90294db!2sLincoln%20Park%20Zoo!5e0!3m2!1sen!2s!4v1770227880184!5m2!1sen!2s"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </section>

</x-website.layout>