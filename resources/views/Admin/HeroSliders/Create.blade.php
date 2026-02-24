<x-admin.layout tabTitle="Create Slide" pageTitle="Manage Hero Sliders" breadcrumb="Home ➔ Hero Sliders ➔ Create">

    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.HeroSliders.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', [
                'sectionTitle' => 'Create New Slide',
                'isBackButton' => true,
                'backURL' => '/admin/hero-sliders',
                'isActionButton' => false,
                'actionButtonText' => '',
                'actionButtonURL' => '',
                'btnClass' => 'btn-dark',
            ])
            <div class="content-wrapper">
                <livewire:admin.forms.hero-sliders.create-hero-slider-form />
            </div>
        </div>
    </div>

</x-admin.layout>
