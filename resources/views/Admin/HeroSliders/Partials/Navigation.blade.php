<ul class="settings-links">
    <li class="divider"><small style="font-size: 0.7em;">— Manage Hero Sliders</small></li>
    <li>
        <a href="/admin/hero-sliders/create" class="{{ request()->is('admin/hero-sliders/create') ? 'active' : '' }}">
            Create Slide
        </a>
    </li>
    <li>
        <a href="/admin/hero-sliders" class="{{ request()->is('admin/hero-sliders') ? 'active' : '' }}">
            All Slides
        </a>
    </li>
</ul>
