<x-admin.layout tabTitle="Create Page" pageTitle="Manage the Pages" breadcrumb="Home ➔ Content ➔ Pages ➔ Create Page">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Content.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Create a new Page', 'isBackButton' =>
            true, 'backURL' => '/admin/content/pages', 'isActionButton' => false, 'actionButtonText' => 'Add New Page Category',
            'actionButtonURL' => '/admin/pages/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                <livewire:admin.forms.content.create-page-form />
            </div>
        </div>
    </div>
</x-admin.layout>