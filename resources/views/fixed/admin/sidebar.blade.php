<aside class="left-sidebar">
    <div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">STATS</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route("admin.index") }}" aria-expanded="false">
                        <span><i class="ti ti-layout-dashboard"></i></span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">MANAGE</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route("admin.properties.index") }}" aria-expanded="false">
                        <span>
                          <i class="ti ti-building-estate"></i>
                        </span>
                        <span class="hide-menu">Properties</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route("admin.users.index") }}" aria-expanded="false">
                        <span>
                          <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Users</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
