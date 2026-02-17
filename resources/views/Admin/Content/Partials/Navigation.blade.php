<ul class="settings-links">
    <li class="divider"><small style="font-size: 0.7em;">— Manage Blog Posts</small></li>
    <li><a href="/admin/content/posts/create" class="{{ request()->is('admin/content/posts/create') ? 'active' : '' }}">Create Post</a></li>
    <li><a href="/admin/content/posts" class="{{ request()->is('admin/content/posts') ? 'active' : '' }}">All Posts</a></li>

    <li class="divider"><small style="font-size: 0.7em;">— Manage News</small></li>
    <li><a href="/admin/content/news/create" class="{{ request()->is('admin/content/news/create') ? 'active' : '' }}">Create News</a></li>
    <li><a href="/admin/content/news" class="{{ request()->is('admin/content/news') ? 'active' : '' }}">All News</a></li>

    <li class="divider"><small style="font-size: 0.7em;">— Manage Stories</small></li>
    <li><a href="/admin/content/stories/create" class="{{ request()->is('admin/content/stories/create') ? 'active' : '' }}">Create Story</a></li>
    <li><a href="/admin/content/stories" class="{{ request()->is('admin/content/stories') ? 'active' : '' }}">All Stories</a></li>

    <li class="divider"><small style="font-size: 0.7em;">— Manage Pages</small></li>
    <li><a href="/admin/content/pages/create" class="{{ request()->is('admin/content/pages/create') ? 'active' : '' }}">Create Page</a></li>
    <li><a href="/admin/content/pages" class="{{ request()->is('admin/content/pages') ? 'active' : '' }}">All Pages</a></li>
</ul>