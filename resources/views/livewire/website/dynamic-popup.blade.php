<div>
    @if ($popupData)
        <div class="reminder-popup-backdrop" id="dynamicPopup" aria-hidden="true" data-popup-id="{{ $popupData['id'] }}"
            data-cooldown-hours="{{ $popupData['cooldown_hours'] }}">

            <div class="reminder-popup" role="dialog" aria-modal="true">

                {{-- Close X button --}}
                <button type="button" class="reminder-popup-close" id="dynamicPopupClose" aria-label="Close popup">
                    ×
                </button>

                <div class="reminder-popup-inner">

                    {{-- ── LEFT: Logo + Image + Title + Description ── --}}
                    <div class="reminder-popup-left">
                        <div class="reminder-popup-card">
                            <img src="/src/images/header-logo.png" alt="{{ config('app.name') }}"
                                class="reminder-popup-logo">

                            <img src="{{ $popupData['cover_image_url'] }}" alt="{{ $popupData['title'] }}"
                                class="reminder-popup-img">

                            <div class="reminder-popup-card-body">
                                <h3 class="reminder-popup-heading">
                                    {!! nl2br(e($popupData['title'])) !!}
                                </h3>
                                @if ($popupData['description'])
                                    <p class="reminder-popup-text">
                                        {!! $popupData['description'] !!}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- ── RIGHT: Maybe Next Time + Bell + Email ── --}}
                    <div class="reminder-popup-right">

                        <h5 class="Subscribe-heading">Maybe Next Time?</h5>

                        <div class="subscribe-bell">
                            <img src="/src/icons/subscribe-bell.svg" alt="bell">
                        </div>

                        <div class="subscribe-form w-100">
                            <p class="Subscribe-sub-title">
                                Please leave your email address below, and we'll send you a gentle reminder later.
                            </p>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white border-end-0">
                                    <img src="/src/icons/mail.svg" alt="mail">
                                </span>
                                <input type="email" id="reminderEmail" class="form-control border-start-0"
                                    placeholder="Enter Email Address">
                            </div>
                            <small class="text-danger d-none" id="reminderEmailError">
                                Please enter a valid email address.
                            </small>
                        </div>

                        <div class="subscribe-btns mt-3 w-100">
                            {{-- Remind Me Later / Make an Impact button --}}
                            @if ($popupData['redirect_url'])
                                <a href="{{ $popupData['redirect_url'] }}" id="dynamicPopupImpactBtn"
                                    class="btn d-flex justify-content-center align-items-center w-100">
                                    {{ $popupData['button_text'] }}
                                </a>
                            @else
                                <button type="button" id="dynamicPopupImpactBtn" class="btn w-100">
                                    {{ $popupData['button_text'] }}
                                </button>
                            @endif

                            <button type="button" class="btn no-thank-btn mt-3 w-100" id="dynamicPopupClose2">
                                No, Thanks
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script>
            (function() {
                var popup = document.getElementById('dynamicPopup');
                if (!popup) return;

                var popupId = popup.getAttribute('data-popup-id');
                var cooldownHrs = parseInt(popup.getAttribute('data-cooldown-hours') || '6', 10);
                var storageKey = 'yafa_popup_closed_' + popupId;
                var closeBtn1 = document.getElementById('dynamicPopupClose');
                var closeBtn2 = document.getElementById('dynamicPopupClose2');
                var impactBtn = document.getElementById('dynamicPopupImpactBtn');

                function shouldShow() {
                    var last = localStorage.getItem(storageKey);
                    if (!last) return true;
                    return (Date.now() - parseInt(last, 10)) >= (cooldownHrs * 3600000);
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
                    localStorage.setItem(storageKey, Date.now().toString());
                }

                window.addEventListener('load', function() {
                    if (shouldShow()) setTimeout(openPopup, 800);
                });

                if (closeBtn1) closeBtn1.addEventListener('click', closePopup);
                if (closeBtn2) closeBtn2.addEventListener('click', closePopup);

                popup.addEventListener('mousedown', function(e) {
                    if (e.target === popup) closePopup();
                });

                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && popup.classList.contains('is-open')) closePopup();
                });

                if (impactBtn) {
                    impactBtn.addEventListener('click', function() {
                        localStorage.setItem(storageKey, Date.now().toString());
                    });
                }
            })();
        </script>
    @endif
</div>
