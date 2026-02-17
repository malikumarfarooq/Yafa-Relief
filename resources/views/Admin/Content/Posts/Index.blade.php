<x-admin.layout tabTitle="All Posts" pageTitle="Manage the Content" breadcrumb="Home ➔ Content ➔ Posts">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Content.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'All Blog Posts', 'isBackButton' =>
            false, 'backURL' => '/admin/posts', 'isActionButton' => true, 'actionButtonText' => 'Add New Post',
            'actionButtonURL' => '/admin/content/posts/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                <livewire:admin.lists.content.posts-list />
            </div>
        </div>
    </div>
</x-admin.layout>