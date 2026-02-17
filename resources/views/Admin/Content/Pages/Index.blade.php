<x-admin.layout tabTitle="All Pages" pageTitle="Manage the Content" breadcrumb="Home ➔ Content ➔ Pages">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Content.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'All Pages', 'isBackButton' =>
            false, 'backURL' => '/admin/pages', 'isActionButton' => true, 'actionButtonText' => 'Add New Page',
            'actionButtonURL' => '/admin/content/pages/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                <livewire:admin.lists.content.pages-list />
            </div>
        </div>
    </div>
</x-admin.layout>