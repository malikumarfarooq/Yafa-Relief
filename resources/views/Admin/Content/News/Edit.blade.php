<x-admin.layout tabTitle="Edit News: {{ $news->title }}" pageTitle="Manage the Content" breadcrumb="Home ➔ Content ➔ News ➔ Edit News: {{ $news->title }}">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Content.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Edit News:'.$news->title, 'isBackButton' =>
            true, 'backURL' => '/admin/content/news', 'isActionButton' => false, 'actionButtonText' => 'Add New News Category',
            'actionButtonURL' => '/admin/programs/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                @livewire('admin.forms.content.edit-news-form', ['news' => $news])
            </div>
        </div>
    </div>
</x-admin.layout>