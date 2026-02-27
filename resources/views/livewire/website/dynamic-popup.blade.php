<div>
    @if ($popupData)
        <div class="reminder-popup-backdrop" id="dynamicPopup" aria-hidden="true" data-popup-id="{{ $popupData['id'] }}"
            data-cooldown-hours="{{ $popupData['cooldown_hours'] }}">

            <div class="reminder-popup" role="dialog" aria-modal="true">

                {{-- Close X button --}}
                <button type="button" class="reminder-popup-close" id="dynamicPopupClose" aria-label="Close popup">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>

                <div class="reminder-popup-inner">

                    {{-- ── LEFT: Image + Description ── --}}
                    <div class="reminder-popup-left">
                        <div class="reminder-popup-card">

                            <img src="{{ asset('src/images/header-logo.png') }}" alt="{{ config('app.name') }}"
                                class="reminder-popup-logo">

                            @if ($popupData['cover_image_url'])
                                <img src="{{ $popupData['cover_image_url'] }}" alt="{{ $popupData['title'] }}"
                                    class="reminder-popup-img">
                            @endif

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

                    {{-- ── RIGHT: CTA ── --}}
                    <div class="reminder-popup-right">

                        <div class="subscribe-form w-100">
                            <h5 class="Subscribe-sub-title">Let's Make an Impact</h5>

                            @if ($popupData['short_description'])
                                <p class="mt-3 mb-0"
                                    style="font-size:16px; line-height:26px; text-align:center;
                                  width:85%; margin-left:auto; margin-right:auto;">
                                    {{ $popupData['short_description'] }}
                                </p>
                            @endif
                        </div>

                        <div class="subscribe-btns mt-4 w-100">

                            {{-- Make an Impact button --}}
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
    @endif
</div>
