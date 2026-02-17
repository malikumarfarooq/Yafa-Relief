<x-admin.layout tabTitle="Create Story" storyTitle="Manage the Storys" breadcrumb="Home ➔ Content ➔ Storys ➔ Create Story">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Content.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Create a new Story', 'isBackButton' =>
            true, 'backURL' => '/admin/content/stories', 'isActionButton' => false, 'actionButtonText' => 'Add New Story Category',
            'actionButtonURL' => '/admin/storys/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                <livewire:admin.forms.content.create-story-form />
            </div>
        </div>
    </div>
</x-admin.layout>