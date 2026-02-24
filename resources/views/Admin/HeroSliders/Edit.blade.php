<x-admin.layout tabTitle="Edit Slide" pageTitle="Manage Hero Sliders" breadcrumb="Home ➔ Hero Sliders ➔ Edit">

    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.HeroSliders.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', [
                'sectionTitle' => 'Edit Slide',
                'isBackButton' => true,
                'backURL' => '/admin/hero-sliders',
                'isActionButton' => false,
                'actionButtonText' => '',
                'actionButtonURL' => '',
                'btnClass' => 'btn-dark',
            ])
            <div class="content-wrapper">
                <livewire:admin.forms.hero-sliders.edit-hero-slider-form :heroSlider="$heroSlider" />
            </div>
        </div>
    </div>

</x-admin.layout>
