<x-admin.layout tabTitle="Edit Post: {{ $post->title }}" pageTitle="Manage the Content" breadcrumb="Home ➔ Content ➔ Posts ➔ Edit Post: {{ $post->title }}">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Content.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Edit Post:'.$post->title, 'isBackButton' =>
            true, 'backURL' => '/admin/content/posts', 'isActionButton' => false, 'actionButtonText' => 'Add New Post Category',
            'actionButtonURL' => '/admin/programs/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                @livewire('admin.forms.content.edit-post-form', ['post' => $post])
            </div>
        </div>
    </div>
</x-admin.layout>