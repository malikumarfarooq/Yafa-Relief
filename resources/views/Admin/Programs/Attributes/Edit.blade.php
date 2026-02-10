<x-admin.layout tabTitle="Edit Program Attribute : {{ $attribute->title }}" pageTitle="Manage the Programs" breadcrumb="Home ➔ Programs ➔ Program Attributes ➔ Edit Attribute">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Programs.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Edit Program Attribute', 'isBackButton' =>
            true, 'backURL' => '/admin/programs/attributes', 'isActionButton' => false, 'actionButtonText' => 'Add New Program Attribute',
            'actionButtonURL' => '/admin/programs/attributes/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                @livewire('admin.forms.edit-program-attribute-form', ['attribute' => $attribute])

            </div>
        </div>
    </div>
</x-admin.layout>