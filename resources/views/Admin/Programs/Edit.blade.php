<x-admin.layout tabTitle="Edit Program: {{ $program->title }}" pageTitle="Manage the Programs"
    breadcrumb="Home ➔ Programs ➔ Edit Program : {{$program->title}}">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Programs.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Edit Program : '.$program->title,
            'isBackButton' =>
            true, 'backURL' => '/admin/programs', 'isActionButton' => false, 'actionButtonText' => 'Add New
            Program Category',
            'actionButtonURL' => '/admin/programs/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                @livewire(
                'admin.forms.edit-program-form',
                ['program' => $program],
                key('edit-program-'.$program->id)
                )


            </div>
        </div>
    </div>
</x-admin.layout>