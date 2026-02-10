<x-admin.layout tabTitle="Programs Attributes" pageTitle="Manage the Programs Attributes" breadcrumb="Home ➔ Programs -> Attributes">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Programs.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Programs Attributes', 'isBackButton' =>
            false, 'backURL' => '/admin/programs', 'isActionButton' => true, 'actionButtonText' => 'Add New Program Attribute',
            'actionButtonURL' => '/admin/programs/attributes/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                @livewire('admin.lists.program-attribute-list')

            </div>
        </div>
    </div>
</x-admin.layout>