<ul class="settings-links">
    <li><a href="/admin/settings" class="{{ request()->is('admin/settings') ? 'active' : '' }}">General</a></li>
    <li><a href="/admin/settings/users" class="{{ request()->is('admin/settings/users*') ? 'active' : '' }}">Users</a></li>
    <li><a href="/admin/settings/roles" class="{{ request()->is('admin/settings/roles*') ? 'active' : '' }}">Roles and Permissions</a></li>
    <li><a href="/admin/settings/notifications" class="{{ request()->is('admin/settings/notifications') ? 'active' : '' }}">Notifications</a></li>
    <li><a href="/admin/settings/billing" class="{{ request()->is('admin/settings/billing') ? 'active' : '' }}">Billing</a></li>
    <li><a href="/admin/settings/integrations" class="{{ request()->is('admin/settings/integrations*') ? 'active' : '' }}">Integrations</a></li>
</ul>