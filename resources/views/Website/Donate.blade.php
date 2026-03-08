<x-website.layout metaTitle="Donation"
    metaDescription="Your support reaches children, mothers, and vulnerable families in crisis. One donation delivers food, medical care, and hope where it's needed most."
    metaKeywords="donate, Gaza, relief, humanitarian, zakat, sadaqah, emergency aid">

    {{-- HERO SECTION --}}
    <section class="global-hero-section donation-hero-sec d-flex justify-content-center flex-column">
        <div class="container">
            <img src="/src/icons/global-hero-heart.svg" alt="">
            <h1>Donate Today. <span>Save Lives</span>.</h1>
            <p class="global-text text-white">
                Your support reaches children, mothers, and vulnerable families in crisis. One donation delivers food,
                medical care, and hope where it's needed most.
            </p>
        </div>
    </section>

    {{-- DONATION DETAIL SECTION --}}
    <section class="donatio-detail-section">
        <div class="container">

            <h5 class="section-badge">BULT ON TRUST</h5>
            <h2 class="h2-title">Donate to Gaza & <span>Save Lives Today</span></h2>
            <h4 class="donation-sub-heading mt-3">The Crisis is Critical. Your Help Cannot Wait.</h4>
            <p class="global-text">
                The humanitarian situation in Gaza has reached a breaking point. Every day, families face the
                devastating reality of displacement, hunger, and a lack of basic medical care. This is not just a call
                for charity; it is a plea for survival. When you donate to Gaza through Yafa Relief, you are providing a
                lifeline to children, mothers, and the elderly who have lost everything.
                <br /><br />
                Your contribution today does more than buy supplies it delivers hope. Whether it is a hot meal for a
                starving child, clean water for a dehydrated family, or emergency medical kits for the injured, your
                support translates directly into life-saving action. The window to help is narrowing. We need your
                support to continue our mission of delivering immediate humanitarian aid to the most vulnerable zones in
                the region.
            </p>

            {{-- SUPPORTING PROGRAM BOXES --}}
            <div class="row mt-5 supporting-boxes">

                @php
                    $programs = [
                        ['title' => 'The Orphan Lifeline: Provide Provide Provide', 'goal' => '$30,000', 'raised' => '$30,000', 'togo' => '$0,000'],
                        ['title' => 'The Orphan Lifeline: Provide Provide Provide', 'goal' => '$30,000', 'raised' => '$30,000', 'togo' => '$0,000'],
                        ['title' => 'The Orphan Lifeline: Provide Provide Provide', 'goal' => '$30,000', 'raised' => '$30,000', 'togo' => '$0,000'],
                        ['title' => 'The Orphan Lifeline: Provide Provide Provide', 'goal' => '$30,000', 'raised' => '$30,000', 'togo' => '$0,000'],
                        ['title' => 'The Orphan Lifeline: Provide Provide Provide', 'goal' => '$30,000', 'raised' => '$30,000', 'togo' => '$0,000'],
                        ['title' => 'The Orphan Lifeline: Provide Provide Provide', 'goal' => '$30,000', 'raised' => '$30,000', 'togo' => '$0,000'],
                    ];
                @endphp

                @foreach ($programs as $program)
                <div class="col-lg-4 col-md-6">
                    <div class="supporting-section-box">
                        <img src="/src/images/supporting-img.webp" alt="" class="supporting-box-img">
                        <h3 class="h3-title my-4">{{ $program['title'] }}</h3>
                        <div class="d-flex justify-content-between align-items-center supporting-box-info">
                            <div>
                                <h6 class="mb-0">Goals</h6>
                                <span>{{ $program['goal'] }}</span>
                            </div>
                            <div></div>
                            <div>
                                <h6 class="mb-0">Raises</h6>
                                <span>{{ $program['raised'] }}</span>
                            </div>
                            <div></div>
                            <div>
                                <h6 class="mb-0">To Go</h6>
                                <span>{{ $program['togo'] }}</span>
                            </div>
                        </div>
                        <a href="#" class="btn d-flex justify-content-center align-items-center mt-3">Donate Now <img
                                src="/src/icons/btn-arrow.svg" alt=""></a>
                    </div>
                </div>
                @endforeach

            </div>

            {{-- HOW YOUR DONATION MAKES IMPACT --}}
            <h2 class="donation-h2-title mt-md-5 mt-3">How Your Donation Makes a Real Impact</h2>
            <p class="global-text mt-4">
                At Yafa Relief, we believe in the power of direct action. We don't just send funds; we deliver
                solutions. Your Gaza emergency relief donation supports four critical pillars of survival:
            </p>

            <h4 class="donation-sub-heading mt-4">1. Food Security & Hot Meals</h4>
            <p class="global-text">
                Starvation is a weapon of war, and hunger is widespread. Our teams are on the ground cooking thousands
                of hot meals daily and distributing non-perishable food parcels. A donation of just a few dollars can
                feed a family for a day. We are fighting famine one meal at a time, but we need your help to keep the
                kitchens running.
            </p>

            <h4 class="donation-sub-heading mt-4">2. Clean Water & Sanitation</h4>
            <p class="global-text">
                Water is life, yet it is scarce in Gaza. Contaminated water is leading to the spread of preventable
                diseases. Yafa Relief operates water trucking services to bring fresh, potable water to displaced
                communities in camps and shelters. Your donation helps us rent trucks, purify water, and distribute it
                to thousands of thirsty people.
            </p>

            <h4 class="donation-sub-heading mt-4">3. Emergency Medical Aid</h4>
            <p class="global-text">
                The healthcare system has collapsed, leaving the injured without care. We supply field hospitals and
                clinics with critical medicines, trauma kits, and surgical supplies. Your support helps doctors save
                limbs and lives under the most impossible conditions.
            </p>

            <h4 class="donation-sub-heading mt-4">4. Winter Relief & Shelter</h4>
            <p class="global-text">
                As temperatures drop, the lack of shelter becomes a death sentence. We provide heavy winter blankets,
                mattresses, and warm clothing to families sleeping in tents or the open air. Donate now to keep a child
                warm this winter.
            </p>

            {{-- WAYS TO GIVE --}}
            <h2 class="donation-h2-title mt-md-5 mt-3">Your Ways to Give, Secure, Fast, and Flexible</h2>
            <p class="global-text mt-4">
                We have made it easier than ever to support the cause. We offer multiple secure avenues for you to send
                help where it is needed most.
            </p>
            <p class="global-text donation-detail-text mt-4">
                <span>Credit Card & Bank Transfer:</span> The fastest way to get funds to the ground.
            </p>
            <p class="global-text donation-detail-text mt-4">
                <span>Cryptocurrency Donations:</span> We are proud to accept crypto donations for Gaza. This ensures
                borderless, instant, and secure transfers of aid. Accepted cryptocurrencies: Bitcoin (BTC), Ethereum
                (ETH), Solana (SOL), and USDT.
            </p>
            <p class="global-text donation-detail-text mt-4">
                <span>Monthly Giving:</span> Become a sustaining partner. A small recurring donation allows us to plan
                long-term relief efforts and respond instantly when new emergencies strike.
            </p>

            {{-- ZAKAT & SADAQAH --}}
            <h2 class="donation-h2-title mt-5">Fulfill Your Religious Obligations: Zakat & Sadaqah</h2>
            <p class="global-text mt-4">
                For our Muslim donors, Yafa Relief offers a trusted pathway to fulfill your religious duties. All our
                emergency relief programs are 100% Zakat Eligible.
            </p>
            <p class="global-text donation-detail-text mt-4">
                <span>Zakat for Gaza:</span> Fulfill your annual obligation by supporting the poorest and most destitute
                families in Gaza. Your Zakat funds are ring-fenced and used strictly for eligible recipients.
            </p>
            <p class="global-text donation-detail-text mt-4">
                <span>Sadaqah & Sadaqah Jariyah:</span> Give a voluntary charity that heals. You can also donate
                towards long-term projects, such as water infrastructure or orphan sponsorship, which count as Sadaqah
                Jariyah — a continuous charity that rewards you even after you pass.
            </p>

            {{-- WHY TRUST YAFA RELIEF --}}
            <h2 class="donation-h2-title mt-md-5 mt-3">Why Trust Yafa Relief?</h2>
            <p class="global-text mt-4">
                In a landscape filled with uncertainty, you need to know your money is effective. Yafa Relief was
                founded on the principles of transparency and speed. We are a grassroots organization with deep roots in
                the community.
            </p>
            <p class="global-text donation-detail-text mt-4">
                <span>No Red Tape:</span> We are agile and can pivot our resources to wherever the bombing or
                displacement is worst.
            </p>
            <p class="global-text donation-detail-text mt-4">
                <span>Transparency:</span> We provide regular updates from the field so you can see exactly where your
                Gaza relief fund contributions are going.
            </p>
            <p class="global-text donation-detail-text mt-4">
                <span>100% Commitment:</span> We are dedicated to this cause for the long haul. A small recurring
                donation allows us to plan long-term relief efforts and respond instantly when new emergencies strike.
            </p>

        </div>
    </section>

</x-website.layout>