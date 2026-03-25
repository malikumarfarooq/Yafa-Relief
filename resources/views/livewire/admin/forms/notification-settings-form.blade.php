<div>
    <form wire:submit.prevent="save">

        {{-- Page Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="mb-0 fw-semibold">Email Notification Settings</h5>
            <button type="submit" class="btn btn-dark px-4" wire:loading.attr="disabled">
                <span wire:loading.remove>Save Settings</span>
                <span wire:loading>Saving…</span>
            </button>
        </div>

        {{-- Notifications Table --}}
        <div class="card border shadow-sm">
            <div class="card-body p-0">
                <table class="table table-bordered mb-0" style="border-color: #e5e7eb;">

                    <thead>
                        <tr style="background-color: #f9fafb;">
                            <th class="px-4 py-3" style="color: #e53e3e; font-size: 13px; font-weight: 600; width: 50px; border-color: #e5e7eb;">#</th>
                            <th class="px-4 py-3" style="color: #e53e3e; font-size: 13px; font-weight: 600; border-color: #e5e7eb;">Notification</th>
                            <th class="px-4 py-3" style="color: #e53e3e; font-size: 13px; font-weight: 600; border-color: #e5e7eb;">Description</th>
                            <th class="px-4 py-3 text-center" style="color: #e53e3e; font-size: 13px; font-weight: 600; width: 110px; border-color: #e5e7eb;">Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr style="border-color: #e5e7eb;">
                            <td class="px-4 py-3 text-muted" style="font-size: 13px; border-color: #e5e7eb; vertical-align: middle;">1</td>
                            <td class="px-4 py-3" style="border-color: #e5e7eb; vertical-align: middle;">
                                <span style="color: #e53e3e; font-size: 13px; font-weight: 500;">Donation Confirmation</span>
                            </td>
                            <td class="px-4 py-3 text-muted" style="font-size: 13px; border-color: #e5e7eb; vertical-align: middle;">
                                Donors receive an email receipt after every successful donation
                            </td>
                            <td class="px-4 py-3 text-center" style="border-color: #e5e7eb; vertical-align: middle;">
                                <div class="form-check form-switch d-flex justify-content-center mb-0">
                                    <input class="form-check-input" type="checkbox" wire:model="settings.donation_confirmation" id="donation_confirmation" style="cursor:pointer;">
                                </div>
                            </td>
                        </tr>

                        <tr style="border-color: #e5e7eb;">
                            <td class="px-4 py-3 text-muted" style="font-size: 13px; border-color: #e5e7eb; vertical-align: middle;">2</td>
                            <td class="px-4 py-3" style="border-color: #e5e7eb; vertical-align: middle;">
                                <span style="color: #e53e3e; font-size: 13px; font-weight: 500;">New Donation Alert (Admin)</span>
                            </td>
                            <td class="px-4 py-3 text-muted" style="font-size: 13px; border-color: #e5e7eb; vertical-align: middle;">
                                Admin gets an email alert each time a new donation is received
                            </td>
                            <td class="px-4 py-3 text-center" style="border-color: #e5e7eb; vertical-align: middle;">
                                <div class="form-check form-switch d-flex justify-content-center mb-0">
                                    <input class="form-check-input" type="checkbox" wire:model="settings.admin_new_donation" id="admin_new_donation" style="cursor:pointer;">
                                </div>
                            </td>
                        </tr>

                        <tr style="border-color: #e5e7eb;">
                            <td class="px-4 py-3 text-muted" style="font-size: 13px; border-color: #e5e7eb; vertical-align: middle;">3</td>
                            <td class="px-4 py-3" style="border-color: #e5e7eb; vertical-align: middle;">
                                <span style="color: #e53e3e; font-size: 13px; font-weight: 500;">Newsletter Subscription</span>
                            </td>
                            <td class="px-4 py-3 text-muted" style="font-size: 13px; border-color: #e5e7eb; vertical-align: middle;">
                                New subscribers receive a confirmation email upon sign-up
                            </td>
                            <td class="px-4 py-3 text-center" style="border-color: #e5e7eb; vertical-align: middle;">
                                <div class="form-check form-switch d-flex justify-content-center mb-0">
                                    <input class="form-check-input" type="checkbox" wire:model="settings.newsletter_subscription" id="newsletter_subscription" style="cursor:pointer;">
                                </div>
                            </td>
                        </tr>

                        <tr style="border-color: #e5e7eb;">
                            <td class="px-4 py-3 text-muted" style="font-size: 13px; border-color: #e5e7eb; vertical-align: middle;">4</td>
                            <td class="px-4 py-3" style="border-color: #e5e7eb; vertical-align: middle;">
                                <span style="color: #e53e3e; font-size: 13px; font-weight: 500;">Contact Message Alert (Admin)</span>
                            </td>
                            <td class="px-4 py-3 text-muted" style="font-size: 13px; border-color: #e5e7eb; vertical-align: middle;">
                                Admin is notified whenever a visitor submits the contact form
                            </td>
                            <td class="px-4 py-3 text-center" style="border-color: #e5e7eb; vertical-align: middle;">
                                <div class="form-check form-switch d-flex justify-content-center mb-0">
                                    <input class="form-check-input" type="checkbox" wire:model="settings.contact_message" id="contact_message" style="cursor:pointer;">
                                </div>
                            </td>
                        </tr>

                        <tr style="border-color: #e5e7eb;">
                            <td class="px-4 py-3 text-muted" style="font-size: 13px; border-color: #e5e7eb; vertical-align: middle;">5</td>
                            <td class="px-4 py-3" style="border-color: #e5e7eb; vertical-align: middle;">
                                <span style="color: #e53e3e; font-size: 13px; font-weight: 500;">Program Update Notifications</span>
                            </td>
                            <td class="px-4 py-3 text-muted" style="font-size: 13px; border-color: #e5e7eb; vertical-align: middle;">
                                Subscribers are emailed whenever a program is updated or announced
                            </td>
                            <td class="px-4 py-3 text-center" style="border-color: #e5e7eb; vertical-align: middle;">
                                <div class="form-check form-switch d-flex justify-content-center mb-0">
                                    <input class="form-check-input" type="checkbox" wire:model="settings.program_updates" id="program_updates" style="cursor:pointer;">
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </form>

    {{-- Success Toast --}}
    @if (session()->has('success'))
        <div class="alert alert-success mt-3 d-flex justify-content-between align-items-center gap-3"
             style="position: fixed; bottom: 0; right: 40px; z-index: 9999;">
            <span class="pe-5">{{ session('success') }}</span>
            <span style="font-size: 48px" class="position-absolute top-50 start-100 translate-middle">😎</span>
        </div>
    @endif
</div>