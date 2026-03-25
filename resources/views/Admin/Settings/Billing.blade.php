<x-admin.layout tabTitle="Billing" pageTitle="Manage the Billing Settings"
    breadcrumb="Home ➔ Settings ➔ Billing">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Settings.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Manage the Billing Settings', 'isBackButton' => false, 'backURL' => '/admin/settings/users', 'isActionButton' => false, 'actionButtonText' => 'Add New User', 'actionButtonURL' => '', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                <livewire:admin.forms.billing-settings-form />

            </div>

        </div>
    </div>
</x-admin.layout>