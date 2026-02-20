<aside class="sidebar">
    <div class="sidebar-logo">
        <a href="/dashboard">
            <img src="{{ asset('storage/uploads/system_settings/' . $siteSettings->sitelogo) }}" alt="vexon" />
        </a>
    </div>

    <ul class="sidebar-menu">
        @can('system-dashboard')
            <li>
                <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        @endcan


        <li class="sidebar-dropdown">
            <a href="javascript:void(0)"
                class="{{ request()->is('users*') || request()->is('userrequests*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i>
                <span>User</span>
                <span class="float-end"><i class="fa-solid fa-angle-right"></i></span>
            </a>
            <ul class="sidebar-submenu"
                style="display: {{ request()->is('users*') || request()->is('userrequests*') ? 'block' : 'none' }};">
                <li>
                    <a href="/users" class="{{ request()->is('users') ? 'active' : '' }}">User Listing</a>
                </li>
                <li>
                    <a href="/userrequests" class="{{ request()->is('userrequests') ? 'active' : '' }}">Pending User</a>
                </li>
            </ul>
        </li>

        @can('blog-request')
            <li>
                <a href="/blogrequests" class="{{ request()->is('blogrequests') ? 'active' : '' }}">
                    <i class="fa-solid fa-check-circle"></i>
                    <span>Blog Requests</span>
                </a>
            </li>
        @endcan

        @can('blog-view')
            <li>
                <a href="/myblogs" class="{{ request()->is('myblogs') ? 'active' : '' }}">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>My Blogs</span>
                </a>
            </li>
        @endcan

        @can('category-view')
            <li>
                <a href="/categories" class="{{ request()->is('categories') ? 'active' : '' }}">
                    <i class="fa-solid fa-list"></i>
                    <span>Categories</span>
                </a>
            </li>
        @endcan

        @can('tag-view')
            <li>
                <a href="/tags" class="{{ request()->is('tags') ? 'active' : '' }}">
                    <i class="fa-solid fa-tags"></i>
                    <span>Tags</span>
                </a>
            </li>
        @endcan

        @can('rolesPermission-view')
            <li>
                <a href="/rolesandpermissions" class="{{ request()->is('rolesandpermissions') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-shield"></i>
                    <span>Roles & Permissions</span>
                </a>
            </li>
        @endcan

        @can('system-setting')
            <li>
                <a href="/systemsettings" class="{{ request()->is('systemsettings') ? 'active' : '' }}">
                    <i class="fa-solid fa-gear"></i>
                    <span>System Settings</span>
                </a>
            </li>
        @endcan

    </ul>
</aside>