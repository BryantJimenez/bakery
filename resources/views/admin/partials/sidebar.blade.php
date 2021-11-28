<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="profile-info">
            <figure class="user-cover-image"></figure>
            <div class="user-info">
                <img src="{{ image_exist('/admins/img/users/', Auth::user()->photo, true) }}" width="90" height="90" title="Profile picture" alt="{{ Auth::user()->name." ".Auth::user()->lastname }}">
                <h6 class="">{{ Auth::user()->name." ".Auth::user()->lastname }}</h6>
                <p class="">{!! roleUser(Auth::user()) !!}</p>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu {{ active(['admin', 'admin/profile', 'admin/profile/edit']) }}">
                <a href="{{ route('admin') }}" aria-expanded="{{ menu_expanded(['admin', 'admin/profile', 'admin/profile/edit']) }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span> Home</span>
                    </div>
                </a>
            </li>

            @can('users.index')
            <li class="menu {{ active('admin/users', 0) }}">
                <a href="{{ route('users.index') }}" aria-expanded="{{ menu_expanded('admin/users', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-users"></i> Users</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('customers.index')
            <li class="menu {{ active('admin/customers', 0) }}">
                <a href="{{ route('customers.index') }}" aria-expanded="{{ menu_expanded('admin/customers', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-user"></i> Customers</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('categories.index')
            <li class="menu {{ active('admin/categories', 0) }}">
                <a href="{{ route('categories.index') }}" aria-expanded="{{ menu_expanded('admin/categories', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-box"></i> Categories</span>
                    </div>
                </a>
            </li>
            @endcan
        </ul>

    </nav>

</div>