<ul class="settings-links">
    <li>
        <a href="{{ route('admin.popups.create') }}"
            class="{{ request()->routeIs('admin.popups.create') ? 'active' : '' }}">
            Create Popup
        </a>
    </li>
    <li>
        <a href="{{ route('admin.popups.index') }}"
            class="{{ request()->routeIs('admin.popups.index') ? 'active' : '' }}">
            All Popups
        </a>
    </li>
</ul>
