<x-admin.layout tabTitle="Create Role" pageTitle="Manage the System's Settings"
    breadcrumb="Home ➔ Settings ➔ Users ➔ Create Role">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Settings.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Create a new System\'s Role', 'isBackButton'
            =>
            true, 'backURL' => '/admin/settings/roles', 'isActionButton' => false, 'actionButtonText' => 'Add New User',
            'actionButtonURL' => '/admin/users/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                @livewire('admin.forms.create-role-form')
            </div>
        </div>
    </div>
</x-admin.layout>