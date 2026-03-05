<x-admin.layout tabTitle="Create Popup" pageTitle="Popup Management"
    breadcrumb="Home &rarr; Dashboard &rarr; Popups &rarr; Create Popup">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Popups.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', [
                'sectionTitle' => 'Create a new Popup',
                'isBackButton' => true,
                'backURL' => route('admin.popups.index'),
                'isActionButton' => false,
                'actionButtonText' => '',
                'actionButtonURL' => '',
                'btnClass' => 'btn-dark',
            ])
            <div class="content-wrapper">
                @livewire('admin.forms.popup-form')
            </div>
        </div>
    </div>
</x-admin.layout>
