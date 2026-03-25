<div>
    <form wire:submit.prevent="save">

        {{-- ════════════════════════════════════════
             1. INVOICE & RECEIPT SETTINGS
        ════════════════════════════════════════ --}}
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="mb-0 fw-semibold">Invoice & Receipt Settings</h5>
            <button type="submit" class="btn btn-dark px-4" wire:loading.attr="disabled">
                <span wire:loading.remove>Save Settings</span>
                <span wire:loading>Saving…</span>
            </button>
        </div>

        <div class="card border shadow-sm mb-4">
            <div class="card-body p-0">
                <table class="table table-bordered mb-0" style="border-color:#e5e7eb;">
                    <thead>
                        <tr style="background-color:#f9fafb;">
                            <th class="px-4 py-3" style="color:#e53e3e;font-size:13px;font-weight:600;width:50px;border-color:#e5e7eb;">#</th>
                            <th class="px-4 py-3" style="color:#e53e3e;font-size:13px;font-weight:600;border-color:#e5e7eb;">Setting</th>
                            <th class="px-4 py-3" style="color:#e53e3e;font-size:13px;font-weight:600;border-color:#e5e7eb;">Description</th>
                            <th class="px-4 py-3 text-center" style="color:#e53e3e;font-size:13px;font-weight:600;width:110px;border-color:#e5e7eb;">Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- Auto-send invoice --}}
                        <tr style="border-color:#e5e7eb;">
                            <td class="px-4 py-3 text-muted" style="font-size:13px;border-color:#e5e7eb;vertical-align:middle;">1</td>
                            <td class="px-4 py-3" style="border-color:#e5e7eb;vertical-align:middle;">
                                <span style="color:#e53e3e;font-size:13px;font-weight:500;">Auto-send Invoice</span>
                            </td>
                            <td class="px-4 py-3 text-muted" style="font-size:13px;border-color:#e5e7eb;vertical-align:middle;">
                                Donors will automatically receive their invoice via email after a successful payment
                            </td>
                            <td class="px-4 py-3 text-center" style="border-color:#e5e7eb;vertical-align:middle;">
                                <div class="form-check form-switch d-flex justify-content-center mb-0">
                                    <input class="form-check-input" type="checkbox" wire:model="settings.auto_send_invoice" id="auto_send_invoice" style="cursor:pointer;">
                                </div>
                            </td>
                        </tr>

                        {{-- Include tax --}}
                        <tr style="border-color:#e5e7eb;">
                            <td class="px-4 py-3 text-muted" style="font-size:13px;border-color:#e5e7eb;vertical-align:middle;">2</td>
                            <td class="px-4 py-3" style="border-color:#e5e7eb;vertical-align:middle;">
                                <span style="color:#e53e3e;font-size:13px;font-weight:500;">Include Tax / GST</span>
                            </td>
                            <td class="px-4 py-3 text-muted" style="font-size:13px;border-color:#e5e7eb;vertical-align:middle;">
                                Include tax/GST in invoice calculations — applicable if your organization is tax-exempt
                            </td>
                            <td class="px-4 py-3 text-center" style="border-color:#e5e7eb;vertical-align:middle;">
                                <div class="form-check form-switch d-flex justify-content-center mb-0">
                                    <input class="form-check-input" type="checkbox" wire:model="settings.include_tax" id="include_tax" style="cursor:pointer;">
                                </div>
                            </td>
                        </tr>

                        {{-- Invoice prefix (text input row) --}}
                        <tr style="border-color:#e5e7eb;">
                            <td class="px-4 py-3 text-muted" style="font-size:13px;border-color:#e5e7eb;vertical-align:middle;">3</td>
                            <td class="px-4 py-3" style="border-color:#e5e7eb;vertical-align:middle;">
                                <span style="color:#e53e3e;font-size:13px;font-weight:500;">Invoice Number Prefix</span>
                            </td>
                            <td class="px-4 py-3" style="border-color:#e5e7eb;vertical-align:middle;">
                                <input type="text" class="form-control form-control-sm" style="max-width:220px;"
                                       wire:model="settings.invoice_number_prefix"
                                       placeholder="e.g. INV-2026-">
                                <small class="text-muted">Invoices will be numbered as: INV-2026-001, INV-2026-002 …</small>
                            </td>
                            <td class="px-4 py-3 text-center text-muted" style="font-size:12px;border-color:#e5e7eb;vertical-align:middle;">—</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        {{-- ════════════════════════════════════════
             2. PAYMENT RECONCILIATION
        ════════════════════════════════════════ --}}
        <h5 class="mb-3 fw-semibold">Payment Reconciliation</h5>
        <div class="card border shadow-sm mb-4">
            <div class="card-body p-0">
                <table class="table table-bordered mb-0" style="border-color:#e5e7eb;">
                    <thead>
                        <tr style="background-color:#f9fafb;">
                            <th class="px-4 py-3" style="color:#e53e3e;font-size:13px;font-weight:600;width:50px;border-color:#e5e7eb;">#</th>
                            <th class="px-4 py-3" style="color:#e53e3e;font-size:13px;font-weight:600;border-color:#e5e7eb;">Setting</th>
                            <th class="px-4 py-3" style="color:#e53e3e;font-size:13px;font-weight:600;border-color:#e5e7eb;">Description</th>
                            <th class="px-4 py-3 text-center" style="color:#e53e3e;font-size:13px;font-weight:600;width:110px;border-color:#e5e7eb;">Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- Auto-reconcile --}}
                        <tr style="border-color:#e5e7eb;">
                            <td class="px-4 py-3 text-muted" style="font-size:13px;border-color:#e5e7eb;vertical-align:middle;">1</td>
                            <td class="px-4 py-3" style="border-color:#e5e7eb;vertical-align:middle;">
                                <span style="color:#e53e3e;font-size:13px;font-weight:500;">Auto-reconcile with Stripe</span>
                            </td>
                            <td class="px-4 py-3 text-muted" style="font-size:13px;border-color:#e5e7eb;vertical-align:middle;">
                                Automatically sync payment status from Stripe to your system
                            </td>
                            <td class="px-4 py-3 text-center" style="border-color:#e5e7eb;vertical-align:middle;">
                                <div class="form-check form-switch d-flex justify-content-center mb-0">
                                    <input class="form-check-input" type="checkbox" wire:model="settings.auto_reconcile" id="auto_reconcile" style="cursor:pointer;">
                                </div>
                            </td>
                        </tr>

                        {{-- Failure days --}}
                        <tr style="border-color:#e5e7eb;">
                            <td class="px-4 py-3 text-muted" style="font-size:13px;border-color:#e5e7eb;vertical-align:middle;">2</td>
                            <td class="px-4 py-3" style="border-color:#e5e7eb;vertical-align:middle;">
                                <span style="color:#e53e3e;font-size:13px;font-weight:500;">Mark as Failed After (days)</span>
                            </td>
                            <td class="px-4 py-3" style="border-color:#e5e7eb;vertical-align:middle;">
                                <input type="number" class="form-control form-control-sm" style="max-width:120px;"
                                       wire:model="settings.payment_failure_days"
                                       min="1" max="30" placeholder="7">
                                <small class="text-muted">Pending payments older than this will be marked as failed</small>
                            </td>
                            <td class="px-4 py-3 text-center text-muted" style="font-size:12px;border-color:#e5e7eb;vertical-align:middle;">—</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        {{-- ════════════════════════════════════════
             3. FINANCIAL REPORTING
        ════════════════════════════════════════ --}}
        <h5 class="mb-3 fw-semibold">Financial Reporting</h5>
        <div class="card border shadow-sm mb-4">
            <div class="card-body p-0">
                <table class="table table-bordered mb-0" style="border-color:#e5e7eb;">
                    <thead>
                        <tr style="background-color:#f9fafb;">
                            <th class="px-4 py-3" style="color:#e53e3e;font-size:13px;font-weight:600;width:50px;border-color:#e5e7eb;">#</th>
                            <th class="px-4 py-3" style="color:#e53e3e;font-size:13px;font-weight:600;border-color:#e5e7eb;">Setting</th>
                            <th class="px-4 py-3" style="color:#e53e3e;font-size:13px;font-weight:600;border-color:#e5e7eb;">Description / Value</th>
                            <th class="px-4 py-3 text-center" style="color:#e53e3e;font-size:13px;font-weight:600;width:110px;border-color:#e5e7eb;">Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- Auto generate reports --}}
                        <tr style="border-color:#e5e7eb;">
                            <td class="px-4 py-3 text-muted" style="font-size:13px;border-color:#e5e7eb;vertical-align:middle;">1</td>
                            <td class="px-4 py-3" style="border-color:#e5e7eb;vertical-align:middle;">
                                <span style="color:#e53e3e;font-size:13px;font-weight:500;">Auto-generate Reports</span>
                            </td>
                            <td class="px-4 py-3 text-muted" style="font-size:13px;border-color:#e5e7eb;vertical-align:middle;">
                                Reports will be created and sent automatically according to your schedule
                            </td>
                            <td class="px-4 py-3 text-center" style="border-color:#e5e7eb;vertical-align:middle;">
                                <div class="form-check form-switch d-flex justify-content-center mb-0">
                                    <input class="form-check-input" type="checkbox" wire:model="settings.generate_reports" id="generate_reports" style="cursor:pointer;">
                                </div>
                            </td>
                        </tr>

                        {{-- Report frequency --}}
                        <tr style="border-color:#e5e7eb;">
                            <td class="px-4 py-3 text-muted" style="font-size:13px;border-color:#e5e7eb;vertical-align:middle;">2</td>
                            <td class="px-4 py-3" style="border-color:#e5e7eb;vertical-align:middle;">
                                <span style="color:#e53e3e;font-size:13px;font-weight:500;">Report Frequency</span>
                            </td>
                            <td class="px-4 py-3" style="border-color:#e5e7eb;vertical-align:middle;">
                                <select class="form-select form-select-sm" style="max-width:160px;"
                                        wire:model="settings.report_frequency" id="report_frequency">
                                    <option value="daily">Daily</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                </select>
                            </td>
                            <td class="px-4 py-3 text-center text-muted" style="font-size:12px;border-color:#e5e7eb;vertical-align:middle;">—</td>
                        </tr>

                        {{-- Report email --}}
                        <tr style="border-color:#e5e7eb;">
                            <td class="px-4 py-3 text-muted" style="font-size:13px;border-color:#e5e7eb;vertical-align:middle;">3</td>
                            <td class="px-4 py-3" style="border-color:#e5e7eb;vertical-align:middle;">
                                <span style="color:#e53e3e;font-size:13px;font-weight:500;">Send Reports To</span>
                            </td>
                            <td class="px-4 py-3" style="border-color:#e5e7eb;vertical-align:middle;">
                                <input type="email" class="form-control form-control-sm" style="max-width:260px;"
                                       wire:model="settings.report_email"
                                       placeholder="admin@example.com">
                            </td>
                            <td class="px-4 py-3 text-center text-muted" style="font-size:12px;border-color:#e5e7eb;vertical-align:middle;">—</td>
                        </tr>

                        {{-- Data retention --}}
                        <tr style="border-color:#e5e7eb;">
                            <td class="px-4 py-3 text-muted" style="font-size:13px;border-color:#e5e7eb;vertical-align:middle;">4</td>
                            <td class="px-4 py-3" style="border-color:#e5e7eb;vertical-align:middle;">
                                <span style="color:#e53e3e;font-size:13px;font-weight:500;">Data Retention Period (days)</span>
                            </td>
                            <td class="px-4 py-3" style="border-color:#e5e7eb;vertical-align:middle;">
                                <input type="number" class="form-control form-control-sm" style="max-width:130px;"
                                       wire:model="settings.data_retention_days"
                                       min="30" max="2555" placeholder="365">
                                <small class="text-muted">30 – 2,555 days (~7 years max)</small>
                            </td>
                            <td class="px-4 py-3 text-center text-muted" style="font-size:12px;border-color:#e5e7eb;vertical-align:middle;">—</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        {{-- ════════════════════════════════════════
             4. COMPLIANCE & AUDIT
        ════════════════════════════════════════ --}}
        <h5 class="mb-3 fw-semibold">Compliance & Audit</h5>
        <div class="card border shadow-sm mb-4">
            <div class="card-body p-0">
                <table class="table table-bordered mb-0" style="border-color:#e5e7eb;">
                    <thead>
                        <tr style="background-color:#f9fafb;">
                            <th class="px-4 py-3" style="color:#e53e3e;font-size:13px;font-weight:600;width:50px;border-color:#e5e7eb;">#</th>
                            <th class="px-4 py-3" style="color:#e53e3e;font-size:13px;font-weight:600;border-color:#e5e7eb;">Setting</th>
                            <th class="px-4 py-3" style="color:#e53e3e;font-size:13px;font-weight:600;border-color:#e5e7eb;">Description</th>
                            <th class="px-4 py-3 text-center" style="color:#e53e3e;font-size:13px;font-weight:600;width:110px;border-color:#e5e7eb;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-color:#e5e7eb;">
                            <td class="px-4 py-3 text-muted" style="font-size:13px;border-color:#e5e7eb;vertical-align:middle;">1</td>
                            <td class="px-4 py-3" style="border-color:#e5e7eb;vertical-align:middle;">
                                <span style="color:#e53e3e;font-size:13px;font-weight:500;">Audit Logging</span>
                            </td>
                            <td class="px-4 py-3 text-muted" style="font-size:13px;border-color:#e5e7eb;vertical-align:middle;">
                                Maintains a detailed log of every payment modification for legal compliance
                            </td>
                            <td class="px-4 py-3 text-center" style="border-color:#e5e7eb;vertical-align:middle;">
                                <div class="form-check form-switch d-flex justify-content-center mb-0">
                                    <input class="form-check-input" type="checkbox" wire:model="settings.audit_logging" id="audit_logging" style="cursor:pointer;">
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