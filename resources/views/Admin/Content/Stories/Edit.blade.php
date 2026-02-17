<x-admin.layout tabTitle="Edit Story: {{ $story->title }}" pageTitle="Manage the Stories" breadcrumb="Home ➔ Content ➔ Stories ➔ Edit Story: {{ $story->title }}">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Content.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Edit Story:'.$story->title, 'isBackButton' =>
            true, 'backURL' => '/admin/content/stories', 'isActionButton' => false, 'actionButtonText' => 'Add New Program Category',
            'actionButtonURL' => '/admin/programs/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                @livewire('admin.forms.content.edit-story-form', ['story' => $story])
            </div>
        </div>
    </div>
</x-admin.layout>