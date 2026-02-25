<div class="d-flex align-items-center sidebar-mobile-header">
    <button type="button" class="btn p-1 me-2 ms-2 border" id="sidebarToggle" onclick="toggleSidebar()">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 12H21" stroke="#7B7B7B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M3 6H21" stroke="#7B7B7B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M3 18H21" stroke="#7B7B7B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </button>
    <div class="sidebar-brand-info d-flex align-items-center pt-3 pb-2 px-2 mb-2">
        <img src="/admin-assets/images/logo.png" alt="Logo" class="brand-logo">
        <h2 class="brand-name m-0 p-0 ps-2">{{ env('APP_CRM_TITLE') }}</h2>
    </div>
</div>

<div class="sidebar">
    <div class="sidebar-brand-info d-flex align-items-center mb-2">
        <img src="/admin-assets/images/logo.png" alt="Logo" class="brand-logo">
        <h2 class="brand-name m-0 p-0 ps-2">{{ env('APP_CRM_TITLE') }}</< /h2>
    </div>
    <button type="button" class="sidebar-cross" onclick="toggleSidebar()"><svg width="24" height="24"
            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M10 10L14 14M14 10L10 14M12 3C19.2 3 21 4.8 21 12C21 19.2 19.2 21 12 21C4.8 21 3 19.2 3 12C3 4.8 4.8 3 12 3Z"
                stroke="#7B7B7B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </button>
    <div class="sidebar-nav-list">
        <div class="sidebar-label">— Quick Access</div>
        <div class="sidebar-nav-item {{ url()->current() === url('/admin/dashboard') ? 'active' : '' }}">
            <a class="d-flex align-items-center" href="/admin/dashboard">
                <i class="lni lni-dashboard-square-1 nav-item-icon"></i>
                <div class="sidebar-nav-item-label">Dashboard</div>
            </a>
        </div>
        <div class="sidebar-nav-item {{ request()->is('admin/programs*') ? 'active' : '' }}">
            <a class="d-flex align-items-center" href="/admin/programs">
                <i class="lni lni-shield-dollar nav-item-icon"></i>
                <div class="sidebar-nav-item-label">Programs</div>
            </a>
        </div>
        <div class="sidebar-nav-item {{ request()->is('admin/content*') ? 'active' : '' }}">
            <a class="d-flex align-items-center" href="/admin/content/posts">
                <i class="lni lni-www nav-item-icon"></i>
                <div class="sidebar-nav-item-label">Content</div>
            </a>
        </div>


        <div class="sidebar-nav-item {{ request()->is('admin/hero-sliders*') ? 'active' : '' }}">
            <a class="d-flex align-items-center" href="/admin/hero-sliders">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="nav-item-icon">
                    <path d="M4 6H20M4 12H20M4 18H20" stroke="#7B7B7B" stroke-width="2" stroke-linecap="round" />
                </svg>
                <div class="sidebar-nav-item-label">Hero Sliders</div>
            </a>
        </div>

        <!-- Newsletter Module -->
        <div class="sidebar-nav-item {{ request()->is('admin/settings/newsletters*') ? 'active' : '' }}">
            <a class="d-flex align-items-center" href="{{ route('admin.settings.newsletters.index') }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="nav-item-icon">
                    <path
                        d="M3 8L10.8906 13.2604C11.5624 13.7083 12.4376 13.7083 13.1094 13.2604L21 8M5 19H19C20.1046 19 21 18.1046 21 17V7C21 5.89543 20.1046 5 19 5H5C3.89543 5 3 5.89543 3 7V17C3 18.1046 3.89543 19 5 19Z"
                        stroke="#7B7B7B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                <div class="sidebar-nav-item-label">Newsletters</div>
            </a>
        </div>
        <!-- Conact us Module -->
        <div class="sidebar-nav-item {{ request()->is('admin/contact-messages*') ? 'active' : '' }}">
            <a class="d-flex align-items-center" href="{{ route('admin.contact-messages.index') }}">

                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="nav-item-icon">
                    <path
                        d="M8 10H8.01M12 10H12.01M16 10H16.01M9 16H5C3.89543 16 3 15.1046 3 14V6C3 4.89543 3.89543 4 5 4H19C20.1046 4 21 4.89543 21 6V14C21 15.1046 20.1046 16 19 16H14L9 21V16Z"
                        stroke="#7B7B7B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="sidebar-nav-item-label">Contact Messages</div>
            </a>
        </div>



        <!-- Popup Management Module -->
        <div class="sidebar-nav-item {{ request()->is('admin/popups*') ? 'active' : '' }}">
            <a class="d-flex align-items-center" href="{{ route('admin.popups.index') }}">

                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg" class="nav-item-icon">
                    <path
                        d="M18 10V6C18 4.89543 17.1046 4 16 4H4C2.89543 4 2 4.89543 2 6V14C2 15.1046 2.89543 16 4 16H8M18 10H20C21.1046 10 22 10.8954 22 12V20C22 21.1046 21.1046 22 20 22H10C8.89543 22 8 21.1046 8 20V18M18 10H14M8 18H12M12 18H16M12 18V14M12 14H16M12 14V10"
                        stroke="#7B7B7B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="sidebar-nav-item-label">Popup Management</div>
            </a>
        </div>

        <div class="sidebar-label">— Donations and Reports</div>
        <div class="sidebar-nav-item {{ request()->is('admin/donations*') ? 'active' : '' }}">
            <a class="d-flex align-items-center" href="/admin/donations">
                <i class="lni lni-heart nav-item-icon"></i>
                <div class="sidebar-nav-item-label">Donations</div>
            </a>
        </div>
        <div class="sidebar-nav-item">
            <a class="d-flex align-items-center" href="/dashboard.html">
                <i class="lni lni-bar-chart-4 nav-item-icon"></i>
                <div class="sidebar-nav-item-label">Analytics</div>
            </a>
        </div>
        <div class="sidebar-nav-item">
            <a class="d-flex align-items-center" href="/dashboard.html">
                <i class="lni lni-layers-1 nav-item-icon"></i>
                <div class="sidebar-nav-item-label">Reports</div>
            </a>
        </div>

    </div>
    <div class="sidebar-footer position-absolute bottom-0">
        <div class="sidebar-nav-item {{ request()->is('admin/settings*') ? 'active' : '' }}">
            <a class="d-flex align-items-center" href="/admin/settings">
                <i class="lni lni-gears-3 nav-item-icon"></i>

                <div class="sidebar-nav-item-label">Settings</div>
            </a>
        </div>
        <div class="sidebar-profile dropdown w-100 mt-2">
            <div class="sidebar-profile-section d-flex justify-content-between align-items-center dropdown-toggle"
                data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                <div class="profile-details-section d-flex align-items-center">
                    <img src="{{ auth()->user()->AvatarUrl }}" alt="User Avatar" class="avatar-image me-2">
                    <div>
                        <div class="sidebar-profile-name">{{ auth()->user()->f_name }} {{ auth()->user()->l_name }}
                        </div>
                        <div class="sidebar-profile-role">
                            {{ ucfirst(
                                auth()->user()->roles->first()->name ??
                                    'No Role
                                                                                                                                                                                                                                                                                                                    Assigned',
                            ) }}
                        </div>
                    </div>
                </div>
                <svg width="16" height="26" viewBox="0 0 16 26" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 16L8 20L4 16" stroke="#7B7B7B" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M4 10L8 6L12 10" stroke="#7B7B7B" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>

            <!-- Dropdown Menu -->
            <ul class="dropdown-menu profile-dropdown-menu mb-2 py-2">
                <li class="px-3 py-2">
                    <div class="profile-details-section d-flex align-items-center">
                        <img src="{{ auth()->user()->AvatarUrl }}" alt="User Avatar" class="avatar-image me-2">
                        <div>
                            <div class="sidebar-profile-name">{{ auth()->user()->f_name }}
                                {{ auth()->user()->l_name }}
                            </div>
                            <div class="sidebar-profile-role">
                                {{ ucfirst(
                                    auth()->user()->roles->first()->name ??
                                        'No
                                                                                                                                                                                                                                                                                                                                                                Role Assigned',
                                ) }}
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <hr class="dropdown-divider p-0 m-0">
                </li>
                <li><a class="dropdown-item px-3 py-2 d-flex align-items-center line-hight-100" href="/admin/profile">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.325 4.317C10.751 2.561 13.249 2.561 13.675 4.317C13.7389 4.5808 13.8642 4.82578 14.0407 5.032C14.2172 5.23822 14.4399 5.39985 14.6907 5.50375C14.9414 5.60764 15.2132 5.65085 15.4838 5.62987C15.7544 5.60889 16.0162 5.5243 16.248 5.383C17.791 4.443 19.558 6.209 18.618 7.753C18.4769 7.98466 18.3924 8.24634 18.3715 8.51677C18.3506 8.78721 18.3938 9.05877 18.4975 9.30938C18.6013 9.55999 18.7627 9.78258 18.9687 9.95905C19.1747 10.1355 19.4194 10.2609 19.683 10.325C21.439 10.751 21.439 13.249 19.683 13.675C19.4192 13.7389 19.1742 13.8642 18.968 14.0407C18.7618 14.2172 18.6001 14.4399 18.4963 14.6907C18.3924 14.9414 18.3491 15.2132 18.3701 15.4838C18.3911 15.7544 18.4757 16.0162 18.617 16.248C19.557 17.791 17.791 19.558 16.247 18.618C16.0153 18.4769 15.7537 18.3924 15.4832 18.3715C15.2128 18.3506 14.9412 18.3938 14.6906 18.4975C14.44 18.6013 14.2174 18.7627 14.0409 18.9687C13.8645 19.1747 13.7391 19.4194 13.675 19.683C13.249 21.439 10.751 21.439 10.325 19.683C10.2611 19.4192 10.1358 19.1742 9.95929 18.968C9.7828 18.7618 9.56011 18.6001 9.30935 18.4963C9.05859 18.3924 8.78683 18.3491 8.51621 18.3701C8.24559 18.3911 7.98375 18.4757 7.752 18.617C6.209 19.557 4.442 17.791 5.382 16.247C5.5231 16.0153 5.60755 15.7537 5.62848 15.4832C5.64942 15.2128 5.60624 14.9412 5.50247 14.6906C5.3987 14.44 5.23726 14.2174 5.03127 14.0409C4.82529 13.8645 4.58056 13.7391 4.317 13.675C2.561 13.249 2.561 10.751 4.317 10.325C4.5808 10.2611 4.82578 10.1358 5.032 9.95929C5.23822 9.7828 5.39985 9.56011 5.50375 9.30935C5.60764 9.05859 5.65085 8.78683 5.62987 8.51621C5.60889 8.24559 5.5243 7.98375 5.383 7.752C4.443 6.209 6.209 4.442 7.753 5.382C8.753 5.99 10.049 5.452 10.325 4.317Z"
                                stroke="#7B7B7B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M9 12C9 12.7956 9.31607 13.5587 9.87868 14.1213C10.4413 14.6839 11.2044 15 12 15C12.7956 15 13.5587 14.6839 14.1213 14.1213C14.6839 13.5587 15 12.7956 15 12C15 11.2044 14.6839 10.4413 14.1213 9.87868C13.5587 9.31607 12.7956 9 12 9C11.2044 9 10.4413 9.31607 9.87868 9.87868C9.31607 10.4413 9 11.2044 9 12Z"
                                stroke="#7B7B7B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="ms-3 pt-half">Settings</div>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider p-0 m-0">
                </li>
                <li><a class="dropdown-item text-danger px-3 py-2 d-flex align-items-center line-hight-100"
                        href="/admin/logout">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14 8V6C14 5.46957 13.7893 4.96086 13.4142 4.58579C13.0391 4.21071 12.5304 4 12 4H5C4.46957 4 3.96086 4.21071 3.58579 4.58579C3.21071 4.96086 3 5.46957 3 6V18C3 18.5304 3.21071 19.0391 3.58579 19.4142C3.96086 19.7893 4.46957 20 5 20H12C12.5304 20 13.0391 19.7893 13.4142 19.4142C13.7893 19.0391 14 18.5304 14 18V16M9 12H21M21 12L18 9M21 12L18 15"
                                stroke="#FF2A58" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <div class="ms-3 pt-half">Logout</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
