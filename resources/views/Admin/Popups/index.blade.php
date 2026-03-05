<x-admin.layout tabTitle="Popup Management" pageTitle="Popup Management" breadcrumb="Home → Dashboard → Popups">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Popups.Partials.Navigation', [])
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', [
                'sectionTitle' => 'Popups',
                'isBackButton' => false,
                'backURL' => '',
                'isActionButton' => true,
                'actionButtonText' => 'Add New Popup',
                'actionButtonURL' => route('admin.popups.create'),
                'btnClass' => 'btn-dark',
            ])
            <div class="content-wrapper">
                @livewire('admin.lists.popups-list')
            </div>
        </div>
    </div>
</x-admin.layout>
