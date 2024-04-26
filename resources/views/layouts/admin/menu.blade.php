<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">

            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}" class="{{ request()->routeIs('admin.dashboard') ? 'nav-link active' : 'nav-link' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.phones')}}" class="{{ request()->routeIs('admin.phones') ? 'nav-link active' : 'nav-link' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Phones</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./index3.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard v3</p>
                    </a>
                </li>
            </ul>
        </li>


    </ul>
</nav>
