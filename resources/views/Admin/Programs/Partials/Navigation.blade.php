<ul class="settings-links">

    <li><a href="/admin/programs/create" class="{{ request()->is('admin/programs/create') ? 'active' : '' }}">Create Program</a></li>
    <li><a href="/admin/programs" class="{{ request()->is('admin/programs') ? 'active' : '' }}">All Programs</a></li>
    <li class="divider"><small style="font-size: 0.7em;">— Manage Categories</small></li>
    <li><a href="/admin/programs/categories/create" class="{{ request()->is('admin/programs/categories/create') ? 'active' : '' }}">Create Category</a></li>
    <li><a href="/admin/programs/categories" class="{{ request()->is('admin/programs/categories') ? 'active' : '' }}">All Categories</a></li>
    <li class="divider"><small style="font-size: 0.7em;">— Manage Attributes</small></li>

    <li><a href="/admin/programs/attributes/create" class="{{ request()->is('admin/programs/attributes/create') ? 'active' : '' }}">Create Attribute</a></li>
    <li><a href="/admin/programs/attributes" class="{{ request()->is('admin/programs/attributes') ? 'active' : '' }}">All Attributes</a></li>

</ul>