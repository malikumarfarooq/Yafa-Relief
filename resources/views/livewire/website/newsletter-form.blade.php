<div>
    {{-- Success Message --}}
    @if($successMessage)
        <div class="alert alert-success mt-3 py-2">
            {{ $successMessage }}
        </div>
    @endif

    {{-- Error Message --}}
    @if($errorMessage)
        <div class="alert alert-danger mt-3 py-2">
            {{ $errorMessage }}
        </div>
    @endif

    {{-- Validation Error --}}
    @error('email')
        <div class="alert alert-danger mt-3 py-2">
            {{ $message }}
        </div>
    @enderror

    <div class="position-relative mt-3">
        <input
            type="email"
            wire:model="email"
            placeholder="Email Address"
            class="news-letter-field">
        <button
            wire:click="subscribe"
            wire:loading.attr="disabled"
            class="newsletter-btn">
            {{-- Loading spinner while submitting --}}
            <span wire:loading wire:target="subscribe">...</span>
            <span wire:loading.remove wire:target="subscribe">
                <img src="/src/icons/newsletter-btn.svg" alt="Subscribe">
            </span>
        </button>
    </div>
</div>