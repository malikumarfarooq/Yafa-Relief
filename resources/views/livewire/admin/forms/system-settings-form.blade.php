<div>
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-md-9">
                <h5 class="section-heading fs-16 highlight-text">Primary Details</h5>
                <div class="row pt-3">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="application_title">Site Title / Application Name</label>
                            <input type="text" wire:model="state.application_title" class="form-control" required>
                            <small class="text-muted">The main name of your platform (shown in the browser tab and
                                header).</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="tagline">Tagline / Slogan</label>
                            <input type="text" wire:model="state.tagline" class="form-control" required>
                            <small class="text-muted">A short descriptive tagline that appears in meta or header
                                sections.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="contact_email">Primary Contact Email</label>
                            <input type="email" wire:model="state.contact_email" class="form-control" required>
                            <small class="text-muted">Used for notifications, admin contact, or support
                                messages.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="support_number">Support Contact Number</label>
                            <input type="text" wire:model="state.support_number" class="form-control" required>
                            <small class="text-muted">Support or helpline number shown on the website or
                                invoice.</small>
                        </div>
                    </div>
                </div>

                <h5 class="section-heading fs-16 highlight-text">Language and Currency Preferences</h5>
                <div class="row pt-3">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="default_language">Default Language</label>
                            <input type="text" wire:model="state.default_language" class="form-control" required>
                            <small class="text-muted">Select the primary language for the system interface</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="default_currency">Default Currency</label>
                            <input type="text" wire:model="state.default_currency" class="form-control" required>
                            <small class="text-muted">Defines the default currency symbol and format across the
                                app.</small>
                        </div>
                    </div>
                </div>

                <h5 class="section-heading fs-16 highlight-text">Localization & Time</h5>
                <small class="text-muted">Optional but beneficial for Invoice and Email Templates</small>

                <div class="row pt-3">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="company_name">Company Name</label>
                            <input type="text" wire:model="state.company_name" class="form-control" required>
                            <small class="text-muted">Legal or brand name of your business.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="tax_number">Tax / VAT Number</label>
                            <input type="text" wire:model="state.tax_number" class="form-control" required>
                            <small class="text-muted">Used for invoice generation and compliance.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="website_url">Website URL</label>
                            <input type="url" wire:model="state.website_url" class="form-control" required>
                            <small class="text-muted">Your company’s main domain.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="business_address">Business Address</label>
                            <input type="text" wire:model="state.business_address" class="form-control" required>
                            <small class="text-muted">Physical address for invoices or contact info.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-dark mt-4" wire:loading.attr="disabled">
                                <span wire:loading.remove>Save Changes</span>
                                <span wire:loading>Saving...</span>
                            </button><br>
                            <small class="text-muted">Changes in the General Details are irreversible - so please
                                confirm
                                before saving your changes.</small>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-3">
                <h5 class="section-heading fs-16 highlight-text pb-3">System Identifiers</h5>

                <label>Logo</label>
                <div class="image-box my-1">
                    @if ($logo)
                    <img src="{{ $logo->temporaryUrl() }}" alt="Preview">
                    @elseif(isset($state['logo_path']))
                    <img src="{{ asset('storage/' . $state['logo_path']) }}" alt="Logo">
                    @else
                    <span>No Logo Uploaded</span>
                    @endif

                    <label for="logoInput" class="edit-btn">
                        <i class="lni lni-brush-2"></i>
                    </label>
                    <input type="file" wire:model="logo" id="logoInput" class="hidden-input" style="display:none"
                        accept="image/png, image/jpeg">
                </div>
                <small class="text-muted">PNG and JPG with transparent background - Max: 1024KB</small>

                <br><br>

                <label>Favicon</label>
                <div class="image-box my-1">

                    @if ($favicon)
                    @php
                    $ext = strtolower($favicon->getClientOriginalExtension());
                    @endphp

                    @if (in_array($ext, ['png', 'jpg', 'jpeg', 'webp']))
                    <img src="{{ $favicon->temporaryUrl() }}" alt="Preview">
                    @elseif ($ext === 'ico')
                    <span class="text-muted">ICO file selected (preview not available)</span>
                    @else
                    <span>Unsupported file</span>
                    @endif

                    @elseif(isset($state['favicon_path']))
                    <img src="{{ asset('storage/' . $state['favicon_path']) }}" alt="Favicon">

                    @else
                    <span>No Icon Uploaded</span>
                    @endif

                    <label for="faviconInput" class="edit-btn">
                        <i class="lni lni-brush-2"></i>
                    </label>

                    <input type="file" wire:model="favicon" id="faviconInput" class="hidden-input" style="display:none"
                        accept=".ico,.png">
                </div>

                <small class="text-muted">ICO or PNG file - Max: 512KB</small>

                <br><br>

                <label>System Icon</label>
                <div class="image-box my-1">
                    @if ($system_icon)
                    <img src="{{ $system_icon->temporaryUrl() }}" alt="Preview">
                    @elseif(isset($state['system_icon_path']))
                    <img src="{{ asset('storage/' . $state['system_icon_path']) }}" alt="Icon">
                    @else
                    <span>No Logo Uploaded</span>
                    @endif

                    <label for="iconInput" class="edit-btn">
                        <i class="lni lni-brush-2"></i>
                    </label>
                    <input type="file" wire:model="system_icon" id="iconInput" class="hidden-input" style="display:none"
                        accept="image/png, image/jpeg">
                </div>
                <small class="text-muted">PNG and JPG - Max: 1024KB</small>
            </div>
        </div>

        @if (session()->has('success'))
        <div class="alert alert-success mt-3 d-flex justify-content-between align-items-center gap-3"
            style="position: fixed; bottom: 0px; right: 40px; z-index: 9999;">
            <span class="pe-5">{{ session('success') }}</span> <span style="font-size: 48px"
                class="position-absolute top-50 start-100 translate-middle">😎</span>
        </div>
        @endif

    </form>
</div>