<x-admin.layout tabTitle="All Donations" pageTitle="Donations and Donors" breadcrumb="Home ➔ Donations">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Donations.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'All Donations', 'isBackButton' =>
            false, 'backURL' => '/admin/programs', 'isActionButton' => false, 'actionButtonText' => 'Add New Program Category',
            'actionButtonURL' => '/admin/programs/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                <livewire:admin.lists.donations-list />
            </div>
        </div>
    </div>
</x-admin.layout>