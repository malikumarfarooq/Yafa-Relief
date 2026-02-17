<x-admin.layout tabTitle="All News" pageTitle="Manage the Content" breadcrumb="Home ➔ Content ➔ News">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Content.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'All Blog News', 'isBackButton' =>
            false, 'backURL' => '/admin/news', 'isActionButton' => true, 'actionButtonText' => 'Add New News',
            'actionButtonURL' => '/admin/content/news/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                <livewire:admin.lists.content.news-list />
            </div>
        </div>
    </div>
</x-admin.layout>