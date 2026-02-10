<x-website.layout metaTitle="Donate to Protect the Legacy" metaDescription="Explore our impactful programs at Auntie Legacy, where we work tirelessly to help Black, Indigenous, and People of Color (BIPOC) retain their land and property ownership across the United States. Join us in our mission to protect generational wealth and support families in need." metaKeywords="Auntie Legacy programs, BIPOC land ownership programs, non-profit organization programs, property retention programs, generational wealth programs, legal support programs, community empowerment programs">
    <section class="global-hero-section donation-hero-section d-flex align-items-end justify-content-center">
        <div class="container text-center">
            <h5 class="h5-title">Legal Defense Fund Active</h5>
            <h1 class="h1-title mt-3">Protect a Legacy Today</h1>
            <p class="global-text mt-3 donation-hero-section-text">
                Every contribution is a hand reaching back — steadying what was built long before us.
            </p>
        </div>
    </section>

    <section class="donation-form-section">
        <div class="container">
            <div class="scoll-to-bottom text-center">
                <img src="/src/icons/Arrow-2.svg" alt="">
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-7 col-12">
                    <h2 class="donation-title">Choose How You'd Like to Give</h2>
                    <p class="global-text">
                        Select a giving option that works best for you — whether it's a one-time
                        contribution or ongoing monthly support.
                    </p>
                    <div class="donation-type-selection mt-4">
                        <div class="donation-type-box" data-type="one-time">
                            <div class="donation-type-content">
                                <h3 class="d-flex justify-content-between align-items-center">
                                    One-Time
                                    <div class="donation-type-radio">
                                        <input type="radio" name="donation-type" id="one-time" value="one-time">
                                        <label for="one-time"></label>
                                    </div>
                                </h3>
                                <p>Support a family or program when help is needed most, when it matters most.</p>
                            </div>
                        </div>
                        <div class="donation-type-box active" data-type="monthly">
                            <div class="donation-type-content">
                                <h3 class="d-flex justify-content-between align-items-center">
                                    Monthly
                                    <div class="donation-type-radio">
                                        <input type="radio" name="donation-type" id="monthly" value="monthly" checked>
                                        <label for="monthly"></label>
                                    </div>
                                </h3>
                                <p>Provide ongoing protection and long-term stability through consistent support.</p>
                            </div>
                        </div>
                    </div>
                    <h2 class="donation-title d-flex justify-content-between align-items-center mt-5 flex-wrap gap-md-0 gap-2">Select an Amount
                        <span>Tax Deductible</span></h2>
                    <div class="donation-amount-selection mt-4">
                        <div class="donation-amount-buttons">
                            <button class="donation-amount-btn" data-amount="25">$25</button>
                            <button class="donation-amount-btn active" data-amount="50">$50</button>
                            <button class="donation-amount-btn" data-amount="100">$100</button>
                            <button class="donation-amount-btn" data-amount="120">$120</button>
                            <button class="donation-amount-btn" data-amount="150">$150</button>
                        </div>
                        <div class="donation-other-amount mt-3 position-relative">
                            <input type="number" id="other-amount" placeholder="Other Amount" min="1" class="">
                            <span>$</span>
                        </div>
                    </div>
                    <h2 class="donation-title mt-5">Your Information</h2>
                    <form action="" class="donation-form mt-4">
                        <div class="row">
                            <div class="col-12 donation-fields-group">
                                <label for="">First Name</label>
                                <input type="text" placeholder="Enter your first name" class="mt-2">
                            </div>
                            <div class="col-12 donation-fields-group mt-3">
                                <label for="">Last Name</label>
                                <input type="text" placeholder="Enter your last name" class="mt-2">
                            </div>
                            <div class="col-12 donation-fields-anonymous mt-3">
                                <label for="" class="d-flex align-items-center gap-3">
                                    <input type="checkbox">
                                    Make my donation anonymous
                                </label>
                            </div>
                        </div>
                    </form>
                    <h2 class="donation-title mt-5">Secure Payment Methods</h2>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <button class="donation-payment-btn active"><img src="/src/images/paypal.png" alt=""></button>
                        <button class="donation-payment-btn"><img src="/src/images/stripe.png" alt=""></button>
                        <button class="donation-payment-btn"><img src="/src/images/g-pay.png" alt=""></button>
                    </div>
                </div>
                <div class="col-lg-4 col-12 mt-lg-0 mt-5">
                    <div class="donation-summary-box">
                        <h3>Donation Summary</h3>
                        <p class="d-flex justify-content-between align-items-center mt-4 donation-prices-text">Type
                            <span>One-Time Donation</span></p>
                        <p class="d-flex justify-content-between align-items-center mt-2 donation-prices-text">Program
                            <span>General Fund</span></p>
                        <p class="d-flex justify-content-between align-items-center mt-4 donation-total-price">Total
                            <span>$240.00</span></p>
                        <button
                            class="donation-btn d-flex justify-content-center align-items-center gap-2 mt-5">Complete
                            Donation <img src="/src/icons/next-arrow.svg" alt=""></button>
                        <p class="donation-privacy-text mt-3 mb-0">By clicking, you agree to our Terms of Service and
                            Privacy Policy.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-website.layout>