<x-admin.layout tabTitle="Programs" pageTitle="Manage the Programs" breadcrumb="Home ➔ Programs">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Programs.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Programs', 'isBackButton' =>
            false, 'backURL' => '/admin/programs', 'isActionButton' => true, 'actionButtonText' => 'Add New Program',
            'actionButtonURL' => '/admin/programs/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                @livewire('admin.lists.programs-list')

            </div>
        </div>
    </div>
</x-admin.layout>