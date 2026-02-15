<form wire:submit.prevent="addToCart" class="donation-form">
    <img src="/src/images/donation-gift.png" alt="" class="donation-gift-img">
    <h3 class="h3-title text-center mt-4">{{ $program->title }}</h3>
    <p class="global-text text-center">{{ $program->short_description }}</p>

    <div class="donation-amount-options">
        @if($program->amount_options)
        @foreach($program->amount_options as $opt)
        <button type="button" wire:click="setAmount({{ $opt }})"
            class="donation-amount-option {{ $amount == $opt ? 'selected' : '' }}">
            <span class="donation-amount-check">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.5 3.5L5.5 9.5L2.5 6.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </span>

            <span class="donation-amount-label">Donate</span>
            <span class="donation-amount-value">${{ $opt }}</span>
        </button>
        @endforeach
        @endif
    </div>

    <input type="number" wire:model.live="customAmount" placeholder="Enter Other Amount" class="donate-otherfield">
    <div class="donation-frequency-options d-flex align-items-center gap-2 my-3 mt-4">
        <div class="h6 p-0 m-0">Select Donation Frequency:</div>
        @foreach(['one-time', 'daily', 'weekly', 'monthly'] as $freq)
        <label style="cursor: pointer;">
            <input type="radio" wire:model.live="frequency" value="{{ $freq }}" class="d-none">
            <span class="badge {{ $frequency === $freq ? 'bg-danger' : 'bg-light text-dark border' }} p-2">
                {{ ucfirst(str_replace('-', ' ', $freq)) }}
            </span>
        </label>
        @endforeach
    </div>
    <button type="submit" class="btn btn-dark d-flex align-items-center justify-content-center gap-3 mt-4 w-100">
        <span wire:loading.remove>Donate Now</span>
        <span wire:loading>Adding...</span>
        <img src="/src/icons/btn-arrow.svg" alt="">
    </button>

    @if (session()->has('success'))
    <p class="text-success text-start mt-2 small">{{ session('success') }}</p>
    @endif
        @if (session()->has('error'))
    <p class="text-danger text-start mt-2 small">{{ session('error') }}</p>
    @endif
</form>