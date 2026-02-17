<x-admin.layout tabTitle="Create News" pageTitle="Manage the Content" breadcrumb="Home ➔ Content ➔ News ➔ Create News">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Content.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Create a new News', 'isBackButton' =>
            true, 'backURL' => '/admin/content/news', 'isActionButton' => false, 'actionButtonText' => 'Add New News Category',
            'actionButtonURL' => '/admin/news/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                <livewire:admin.forms.content.create-news-form />
            </div>
        </div>
    </div>
</x-admin.layout>