<x-admin.layout tabTitle="Newsletter Subscribers" pageTitle="Newsletter Subscribers" breadcrumb="Home → Newsletters">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Newsletters.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', [
                'sectionTitle' => 'All Subscribers',
                'isBackButton' => false,
                'backURL' => '',
                'isActionButton' => true,
                'actionButtonText' => 'Export CSV',
                'actionButtonURL' => route('admin.settings.newsletters.export'),
                'btnClass' => 'btn-success',
            ])
            <div class="content-wrapper">
                @livewire('admin.newsletters.index')
            </div>
        </div>
    </div>
</x-admin.layout>
