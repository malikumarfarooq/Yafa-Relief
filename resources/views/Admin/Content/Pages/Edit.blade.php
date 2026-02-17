<x-admin.layout tabTitle="Edit Page: {{ $page->title }}" pageTitle="Manage the Programs" breadcrumb="Home ➔ Content ➔ Pages ➔ Edit Page: {{ $page->title }}">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Content.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Edit Page:'.$page->title, 'isBackButton' =>
            true, 'backURL' => '/admin/content/pages', 'isActionButton' => false, 'actionButtonText' => 'Add New Program Category',
            'actionButtonURL' => '/admin/programs/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                @livewire('admin.forms.content.edit-page-form', ['page' => $page])
            </div>
        </div>
    </div>
</x-admin.layout>