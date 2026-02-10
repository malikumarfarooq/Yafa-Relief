<x-admin.layout tabTitle="Users" pageTitle="Manage the System Settings" breadcrumb="Home ➔ Settings ➔ Users">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Settings.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Manage the System\'s Users', 'isBackButton' =>
            false, 'backURL' => '/admin/settings/users', 'isActionButton' => true, 'actionButtonText' => 'Add New User',
            'actionButtonURL' => '/admin/settings/users/create', 'btnClass' => 'btn-dark'])
            <div class="content-wrapper">
                @livewire('admin.lists.users-list')
                @if (session()->has('success'))
                <div class="alert alert-success mt-3 d-flex justify-content-between align-items-center gap-3"
                    style="position: fixed; bottom: 0px; right: 40px; z-index: 9999;">
                    <span class="pe-5">{{ session('success') }}</span> <span style="font-size: 48px"
                        class="position-absolute top-50 start-100 translate-middle">😎</span>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-admin.layout>