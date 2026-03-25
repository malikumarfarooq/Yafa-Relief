<?php

namespace App\Livewire\Admin\Forms;

use App\Models\SystemSetting;
use Livewire\Component;

class BillingSettingsForm extends Component
{
    public $settings = [];

    protected $rules = [
        'settings.auto_send_invoice' => 'boolean',
        'settings.invoice_number_prefix' => 'nullable|string|max:50',
        'settings.include_tax' => 'boolean',
        'settings.auto_reconcile' => 'boolean',
        'settings.payment_failure_days' => 'nullable|integer|min:1|max:30',
        'settings.generate_reports' => 'boolean',
        'settings.report_frequency' => 'nullable|in:daily,weekly,monthly',
        'settings.report_email' => 'nullable|email',
        'settings.data_retention_days' => 'nullable|integer|min:30|max:2555',
        'settings.audit_logging' => 'boolean',
    ];

    public function mount()
    {
        $this->settings = [
            'auto_send_invoice' => (bool) SystemSetting::getValue('billing_auto_send_invoice', true),
            'invoice_number_prefix' => SystemSetting::getValue('billing_invoice_number_prefix', 'INV-2026-'),
            'include_tax' => (bool) SystemSetting::getValue('billing_include_tax', false),
            'auto_reconcile' => (bool) SystemSetting::getValue('billing_auto_reconcile', true),
            'payment_failure_days' => (int) SystemSetting::getValue('billing_payment_failure_days', 7),
            'generate_reports' => (bool) SystemSetting::getValue('billing_generate_reports', true),
            'report_frequency' => SystemSetting::getValue('billing_report_frequency', 'monthly'),
            'report_email' => SystemSetting::getValue('billing_report_email', config('mail.admin_email')),
            'data_retention_days' => (int) SystemSetting::getValue('billing_data_retention_days', 365),
            'audit_logging' => (bool) SystemSetting::getValue('billing_audit_logging', true),
        ];
    }

    public function save()
    {
        $this->validate();

        SystemSetting::setValue('billing_auto_send_invoice', $this->settings['auto_send_invoice']);
        SystemSetting::setValue('billing_invoice_number_prefix', $this->settings['invoice_number_prefix']);
        SystemSetting::setValue('billing_include_tax', $this->settings['include_tax']);
        SystemSetting::setValue('billing_auto_reconcile', $this->settings['auto_reconcile']);
        SystemSetting::setValue('billing_payment_failure_days', $this->settings['payment_failure_days']);
        SystemSetting::setValue('billing_generate_reports', $this->settings['generate_reports']);
        SystemSetting::setValue('billing_report_frequency', $this->settings['report_frequency']);
        SystemSetting::setValue('billing_report_email', $this->settings['report_email']);
        SystemSetting::setValue('billing_data_retention_days', $this->settings['data_retention_days']);
        SystemSetting::setValue('billing_audit_logging', $this->settings['audit_logging']);

        session()->flash('success', 'Billing settings updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.forms.billing-settings-form');
    }
}
