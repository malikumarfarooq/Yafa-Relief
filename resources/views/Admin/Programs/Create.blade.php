<x-admin.layout tabTitle="Create Program" pageTitle="Manage the Programs" breadcrumb="Home ➔ Programs ➔ Create Program">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Programs.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Create a new Program', 'isBackButton' =>
            true, 'backURL' => '/admin/programs', 'isActionButton' => false, 'actionButtonText' => 'Add New Program Category',
            'actionButtonURL' => '/admin/programs/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                @livewire('admin.forms.create-program-form')

            </div>
        </div>
    </div>
</x-admin.layout>