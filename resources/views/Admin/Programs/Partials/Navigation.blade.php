<ul class="settings-links">

    <li><a href="/admin/programs/create" class="{{ request()->is('admin/programs/create') ? 'active' : '' }}">Create Program</a></li>
    <li><a href="/admin/programs" class="{{ request()->is('admin/programs') ? 'active' : '' }}">All Programs</a></li>
    <li class="divider"><small style="font-size: 0.7em;">— Associated Modules</small></li>
    <li><a href="/admin/programs/categories/create" class="{{ request()->is('admin/programs/categories/create') ? 'active' : '' }}">Create Category</a></li>
    <li><a href="/admin/programs/categories" class="{{ request()->is('admin/programs/categories') ? 'active' : '' }}">All Categories</a></li>

</ul>