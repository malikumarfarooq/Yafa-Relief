<x-admin.layout tabTitle="Create Post" pageTitle="Manage the Content" breadcrumb="Home ➔ Content ➔ Posts ➔ Create Post">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Content.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Create a new Post', 'isBackButton' =>
            true, 'backURL' => '/admin/content/posts', 'isActionButton' => false, 'actionButtonText' => 'Add New Post Category',
            'actionButtonURL' => '/admin/posts/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                <livewire:admin.forms.content.create-post-form />
            </div>
        </div>
    </div>
</x-admin.layout>