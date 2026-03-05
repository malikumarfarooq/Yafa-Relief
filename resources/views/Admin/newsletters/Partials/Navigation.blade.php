<ul class="settings-links">
    <li>
        {{-- <a href="{{ route('admin.newsletters.index') }}" --}}
        <a href="{{ route('admin.settings.newsletters.index') }}"
            class="{{ request()->routeIs('admin.newsletters.index') ? 'active' : '' }}">
            All Subscribers
        </a>
    </li>
</ul>
