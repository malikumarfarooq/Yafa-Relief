<div class="container">

    {{-- Flash error message --}}
    @if(session()->has('error'))
        <div class="alert alert-danger mb-4" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">

        {{-- ── Left column: cart items ─────────────────────────────────────── --}}
        <div class="col-lg-7">
            <h5 class="section-badge">DONATION DETAILS</h5>
            <h2 class="h2-title">Donation <span>Summary</span></h2>
            <p class="global-text mt-3">
                Review your selected donations below. You can adjust quantities or remove items before
                proceeding to checkout.
            </p>

            @if(empty($cart))
                <div class="alert alert-warning mt-5">Your cart is empty.</div>
            @else
                <div class="d-flex flex-column gap-3 mt-5">
                    @foreach($cart as $index => $item)
                        <div class="cart-items d-flex justify-content-between align-items-center">

                            <div class="cart-detail">
                                <h3 class="h3-title">{{ $item['title'] }}</h3>
                                <p class="global-text text-dark fw-bold">
                                    ${{ number_format($item['amount'], 2) }} / {{ ucfirst($item['frequency']) }}
                                </p>
                            </div>

                            <div class="cart-qty-delete d-flex justify-content-end align-items-center gap-3 mt-md-0 mt-4">
                                <div class="position-relative">

                                    {{-- MINUS --}}
                                    <button type="button"
                                            wire:click="decrease({{ $index }})"
                                            class="cart-minus cart-qty-btn">
                                        <img src="/src/icons/minus-btn.svg" alt="Decrease">
                                    </button>

                                    <input type="number"
                                           min="1"
                                           value="{{ $item['quantity'] }}"
                                           class="cart-qty-field text-center"
                                           readonly>

                                    {{-- PLUS --}}
                                    <button type="button"
                                            wire:click="increase({{ $index }})"
                                            class="cart-plus cart-qty-btn">
                                        <img src="/src/icons/plus-btn.svg" alt="Increase">
                                    </button>

                                </div>

                                {{-- DELETE --}}
                                <button type="button"
                                        wire:click="remove({{ $index }})"
                                        class="cart-delete-btn">
                                    <img src="/src/icons/cart-delete.svg" alt="Remove item">
                                </button>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- ── Right column: donor form ────────────────────────────────────── --}}
        <div class="col-lg-5 mt-lg-0 mt-5">
            <div class="cart-detail-form" style="padding-bottom:0px;border-bottom-left-radius: 35px;border-bottom-right-radius: 35px">

                <h3 class="d-flex align-items-center gap-3">
                    <img src="/src/images/cart-detail.png" alt="">Enter Your Details
                </h3>
                <p>Please share your details so we can process your donation and keep you updated.</p>

                <form wire:submit.prevent="proceed" class="mt-4">

                    {{-- First name --}}
                    <div class="cart-field position-relative">
                        <img src="/src/icons/cart-user.svg" alt="">
                        <input type="text"
                               wire:model.defer="first_name"
                               placeholder="First Name"
                               class="@error('first_name') is-invalid @enderror">
                        @error('first_name')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Last name --}}
                    <div class="cart-field position-relative mt-4">
                        <img src="/src/icons/cart-user.svg" alt="">
                        <input type="text"
                               wire:model.defer="last_name"
                               placeholder="Last Name"
                               class="@error('last_name') is-invalid @enderror">
                        @error('last_name')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="cart-field position-relative mt-4">
                        <img src="/src/icons/cart-email.svg" alt="">
                        <input type="email"
                               wire:model.defer="email"
                               placeholder="Email Address"
                               class="@error('email') is-invalid @enderror">
                        @error('email')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Payment method --}}
                    <div class="bg-white p-3 rounded mt-4 d-none">
                        <p class="global-text text-dark mb-3">Select the Payment Method</p>

                        @error('payment_method')
                            <span class="text-danger d-block mb-2">{{ $message }}</span>
                        @enderror

                        <div>
                            <label class="form-check-label global-text">
                                <input type="radio"
                                       wire:model="payment_method"
                                       value="card"
                                       class="form-check-input me-2">
                                Debit / Credit Card
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="form-check-label global-text">
                                <input type="radio"
                                       wire:model="payment_method"
                                       value="paypal"
                                       class="form-check-input me-2">
                                PayPal
                            </label>
                        </div>
                        <div class="mt-2">
                            <label class="form-check-label global-text">
                                <input type="radio"
                                       wire:model="payment_method"
                                       value="bank"
                                       class="form-check-input me-2">
                                Direct Bank Transfer
                            </label>
                        </div>
                    </div>

                    <br>
                    <a href="#" class="mt-3 text-white">Terms and Conditions</a> will be applied.

                    {{-- ── Total + submit (inside the form) ───────────────────── --}}
                    <div class="d-flex align-items-center mt-4" style="margin-left:-30px; margin-right:-30px;">
                        <div class="cart-total">
                            <span>Total Amount</span>
                            <h6 class="mb-0 mt-2">
                                ${{ number_format($total, 2) }}
                            </h6>
                        </div>

                        <button type="submit"
                                class="cart-main-btn btn d-flex justify-content-center align-items-center gap-2"
                                wire:loading.attr="disabled">
                            <span wire:loading.remove>Continue</span>
                            <span wire:loading>Processing…</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>