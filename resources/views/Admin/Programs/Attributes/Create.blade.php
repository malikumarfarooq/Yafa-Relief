<x-admin.layout tabTitle="Create Program Attribute" pageTitle="Manage the Programs" breadcrumb="Home ➔ Programs ➔ Program Attributes ➔ Create Attribute">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Programs.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Create a new Program Attribute', 'isBackButton' =>
            true, 'backURL' => '/admin/programs/attributes', 'isActionButton' => false, 'actionButtonText' => 'Add New Program Attribute',
            'actionButtonURL' => '/admin/programs/attributes/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                @livewire('admin.forms.create-program-attribute-form')

            </div>
        </div>
    </div>
</x-admin.layout>