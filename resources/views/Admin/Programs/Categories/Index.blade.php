<x-admin.layout tabTitle="Programs Categories" pageTitle="Manage the Programs Categories" breadcrumb="Home ➔ Programs -> Categories">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Programs.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Programs Categories', 'isBackButton' =>
            false, 'backURL' => '/admin/programs', 'isActionButton' => true, 'actionButtonText' => 'Add New Program Category',
            'actionButtonURL' => '/admin/programs/categories/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                @livewire('admin.lists.program-category-list')

            </div>
        </div>
    </div>
</x-admin.layout>