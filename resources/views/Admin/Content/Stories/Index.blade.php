<x-admin.layout tabTitle="All Stories" pageTitle="Manage the Content" breadcrumb="Home ➔ Content ➔ Stories">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Content.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'All Stories', 'isBackButton' =>
            false, 'backURL' => '/admin/pages', 'isActionButton' => true, 'actionButtonText' => 'Add New Story',
            'actionButtonURL' => '/admin/content/stories/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                <livewire:admin.lists.content.stories-list />
            </div>
        </div>
    </div>
</x-admin.layout>