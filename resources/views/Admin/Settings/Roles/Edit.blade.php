<x-admin.layout tabTitle="Edit Role" pageTitle="Manage the System's Settings"
    breadcrumb="Home ➔ Settings ➔ Roles ➔ Edit Role">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Settings.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Edit System\'s Role : ' . $role->name, 'isBackButton'
            =>
            true, 'backURL' => '/admin/settings/roles', 'isActionButton' => false, 'actionButtonText' => 'Add New User',
            'actionButtonURL' => '/admin/seusers/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper position-relative">
                @livewire('admin.forms.edit-role-form', ['role' => $role], key('edit-role-form-' . $role->id))
            </div>
        </div>
    </div>
</x-admin.layout>