<x-admin.layout tabTitle="Edit Program Category : {{ $category->title }}" pageTitle="Manage the Programs" breadcrumb="Home ➔ Programs ➔ Program Categories ➔ Edit Category">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Programs.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Edit Program Category', 'isBackButton' =>
            true, 'backURL' => '/admin/programs/categories', 'isActionButton' => false, 'actionButtonText' => 'Add New Program Category',
            'actionButtonURL' => '/admin/programs/categories/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                @livewire('admin.forms.edit-program-category-form', ['category' => $category])

            </div>
        </div>
    </div>
</x-admin.layout>