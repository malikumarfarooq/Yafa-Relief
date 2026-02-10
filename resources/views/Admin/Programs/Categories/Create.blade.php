<x-admin.layout tabTitle="Create Program Category" pageTitle="Manage the Programs" breadcrumb="Home ➔ Programs ➔ Program Categories ➔ Create Category">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Programs.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Create a new Program Category', 'isBackButton' =>
            true, 'backURL' => '/admin/programs/categories', 'isActionButton' => false, 'actionButtonText' => 'Add New Program Category',
            'actionButtonURL' => '/admin/programs/categories/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                @livewire('admin.forms.create-program-category-form')

            </div>
        </div>
    </div>
</x-admin.layout>