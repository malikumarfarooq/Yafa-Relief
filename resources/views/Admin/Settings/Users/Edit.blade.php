<x-admin.layout tabTitle="Create User" pageTitle="Manage the System's Settings" breadcrumb="Home ➔ Settings ➔ Users ➔ Create User">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Settings.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Edit a new System\'s User', 'isBackButton' =>
            true, 'backURL' => '/admin/settings/users', 'isActionButton' => false, 'actionButtonText' => 'Add New User',
            'actionButtonURL' => '/admin/users/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                @livewire('admin.forms.edit-user-form', ['user' => $user])
            </div>
        </div>
    </div>
</x-admin.layout>