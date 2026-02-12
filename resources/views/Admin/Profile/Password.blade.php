<x-admin.layout tabTitle="Profile Password" pageTitle="Manage my profile details and settings"
    breadcrumb="Home ➔ Profile ➔ Password">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Profile.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Profile Password', 'isBackButton' =>
            true, 'backURL' => '/admin/profile', 'isActionButton' => false, 'actionButtonText' => 'Add New User',
            'actionButtonURL' => '/admin/users/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                <livewire:admin.forms.change-my-password-form />
            </div>
        </div>
    </div>
</x-admin.layout>