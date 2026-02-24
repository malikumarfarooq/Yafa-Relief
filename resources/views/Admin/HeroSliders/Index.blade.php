<x-admin.layout tabTitle="Hero Sliders" pageTitle="Manage Hero Sliders" breadcrumb="Home ➔ Hero Sliders">

    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.HeroSliders.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', [
                'sectionTitle' => 'All Slides',
                'isBackButton' => false,
                'backURL' => '/admin/hero-sliders',
                'isActionButton' => true,
                'actionButtonText' => 'Add New Slide',
                'actionButtonURL' => '/admin/hero-sliders/create',
                'btnClass' => 'btn-dark',
            ])
            <div class="content-wrapper">
                <livewire:admin.lists.hero-sliders.hero-slider-list />
            </div>
        </div>
    </div>

</x-admin.layout>
