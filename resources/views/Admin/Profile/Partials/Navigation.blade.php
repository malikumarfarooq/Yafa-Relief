<ul class="settings-links">
    <li><a href="/admin/profile" class="{{ request()->is('admin/profile') ? 'active' : '' }}">My Profile</a></li>
    <li><a href="/admin/profile/edit" class="{{ request()->is('admin/profile/edit') ? 'active' : '' }}">Edit Profile</a></li>
    <li><a href="/admin/profile/security" class="{{ request()->is('admin/profile/security') ? 'active' : '' }}">Security Settings</a></li>
    <li><a href="/admin/profile/password" class="{{ request()->is('admin/profile/password') ? 'active' : '' }}">Change Password</a></li>

    
</ul>