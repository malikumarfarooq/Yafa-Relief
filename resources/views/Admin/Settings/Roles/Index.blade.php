<x-admin.layout tabTitle="Roles and Permissions" pageTitle="Manage the System Settings" breadcrumb="Home ➔ Settings ➔ Roles and Permissions">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Settings.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Manage the System\'s Roles and Permissions', 'isBackButton' =>
            false, 'backURL' => '/admin/settings/users', 'isActionButton' => true, 'actionButtonText' => 'Add New
            Role', 'actionButtonURL' => '/admin/settings/roles/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                @livewire('admin.lists.roles-list')

            </div>
        </div>
    </div>
</x-admin.layout>