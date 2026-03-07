<div>
    {{-- @if ($successMessage)
        <div class="alert alert-success mt-3">
            {{ $successMessage }}
        </div>
    @endif --}}

    <div class="row mt-4">
        <div class="col-md-6 form-fields-group">
            <label>First Name </label>
            <input type="text" wire:model="first_name" placeholder="Enter Your First Name">
            @error('first_name')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 form-fields-group mt-md-0 mt-4">
            <label>Last Name </label>
            <input type="text" wire:model="last_name" placeholder="Enter Your Last Name">
            @error('last_name')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 form-fields-group mt-4">
            <label>Email Address</label>
            <input type="email" wire:model="email" placeholder="Enter Your Email Address">
            @error('email')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 form-fields-group mt-4">
            <label>Phone Number</label>
            <input type="text" wire:model="phone" placeholder="Enter Your Phone Number">
        </div>
        {{-- <div class="col-12 form-fields-group mt-4">
            <label>Subject</label>
            <input type="text" wire:model="subject" placeholder="Enter Subject">
        </div> --}}
        <div class="col-12 form-fields-group mt-4">
            <label>Message </label>
            <textarea wire:model="message" placeholder="Write your message here..."></textarea>
            @error('message')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        @if ($successMessage)
            <div class="alert alert-success mt-3">
                {{ $successMessage }}
            </div>
        @endif

        <div class="col-12 mt-4">
            <button wire:click="submit" wire:loading.attr="disabled"
                class="btn d-flex justify-content-center align-items-center gap-2">
                <span wire:loading wire:target="submit">Sending...</span>
                <span wire:loading.remove wire:target="submit">
                    Send Message <img src="/src/icons/btn-arrow.svg" alt="">
                </span>
            </button>
        </div>
    </div>
</div>
