 <aside class="sidebar">
            <div class="sidebar-logo">
            <a href="/dashboard">
                <img src="{{ asset('assets/img/logo/header-logo1.png') }}" alt="vexon" />
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
