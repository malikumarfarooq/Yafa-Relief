<x-admin.layout tabTitle="Edit Popup" pageTitle="Popup Management" breadcrumb="Home → Dashboard → Popups → Edit Popup">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Popups.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', [
                'sectionTitle' => 'Edit Popup',
                'isBackButton' => true,
                'backURL' => route('admin.popups.index'),
                'isActionButton' => false,
                'actionButtonText' => '',
                'actionButtonURL' => '',
                'btnClass' => 'btn-dark',
            ])
            <div class="content-wrapper">
                @livewire('admin.forms.popup-form', ['id' => $popup->id])
            </div>
        </div>
    </div>
</x-admin.layout>
