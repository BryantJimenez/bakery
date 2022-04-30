<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="profile-info">
            <figure class="user-cover-image"></figure>
            <div class="user-info">
                <img src="{{ image_exist('/admins/img/users/', Auth::user()->photo, true) }}" width="90" height="90" title="Foto de perfil" alt="{{ Auth::user()->name." ".Auth::user()->lastname }}">
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
                        <span> @lang('admin.sidebar.home')</span>
                    </div>
                </a>
            </li>

            @can('users.index')
            <li class="menu {{ active('admin/users', 0) }}">
                <a href="{{ route('users.index') }}" aria-expanded="{{ menu_expanded('admin/users', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-users"></i> @lang('admin.sidebar.users')</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('customers.index')
            <li class="menu {{ active('admin/customers', 0) }}">
                <a href="{{ route('customers.index') }}" aria-expanded="{{ menu_expanded('admin/customers', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-user"></i> @lang('admin.sidebar.customers')</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('categories.index')
            <li class="menu {{ active('admin/categories', 0) }}">
                <a href="{{ route('categories.index') }}" aria-expanded="{{ menu_expanded('admin/categories', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-box"></i> @lang('admin.sidebar.categories')</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('products.index')
            <li class="menu {{ active('admin/products', 0) }}">
                <a href="{{ route('products.index') }}" aria-expanded="{{ menu_expanded('admin/products', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-hamburger"></i> @lang('admin.sidebar.products')</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('complements.index')
            <li class="menu {{ active('admin/complements', 0) }}">
                <a href="{{ route('complements.index') }}" aria-expanded="{{ menu_expanded('admin/complements', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-puzzle-piece"></i> @lang('admin.sidebar.complements')</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('groups.index')
            <li class="menu {{ active('admin/groups', 0) }}">
                <a href="{{ route('groups.index') }}" aria-expanded="{{ menu_expanded('admin/groups', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-th"></i> @lang('admin.sidebar.groups')</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('orders.index')
            <li class="menu {{ active('admin/orders', 0) }}">
                <a href="{{ route('orders.index') }}" aria-expanded="{{ menu_expanded('admin/orders', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-shopping-cart"></i> @lang('admin.sidebar.orders')</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('agencies.index')
            <li class="menu {{ active('admin/agencies', 0) }}">
                <a href="{{ route('agencies.index') }}" aria-expanded="{{ menu_expanded('admin/agencies', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-building"></i> @lang('admin.sidebar.agencies')</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('attributes.index')
            <li class="menu {{ active('admin/attributes', 0) }}">
                <a href="{{ route('attributes.index') }}" aria-expanded="{{ menu_expanded('admin/attributes', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-tags"></i> @lang('admin.sidebar.attributes')</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('coupons.index')
            <li class="menu {{ active('admin/coupons', 0) }}">
                <a href="{{ route('coupons.index') }}" aria-expanded="{{ menu_expanded('admin/coupons', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fas fa-ticket-alt"></i> @lang('admin.sidebar.coupons')</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('currencies.index')
            <li class="menu {{ active('admin/currencies', 0) }}">
                <a href="{{ route('currencies.index') }}" aria-expanded="{{ menu_expanded('admin/currencies', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-dollar-sign"></i> @lang('admin.sidebar.currencies')</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('languages.index')
            <li class="menu {{ active('admin/languages', 0) }}">
                <a href="{{ route('languages.index') }}" aria-expanded="{{ menu_expanded('admin/languages', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-language"></i> @lang('admin.sidebar.languages')</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('schedules.index')
            <li class="menu {{ active('admin/schedules', 0) }}">
                <a href="{{ route('schedules.index') }}" aria-expanded="{{ menu_expanded('admin/schedules', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-calendar"></i> @lang('admin.sidebar.schedules')</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('settings.edit')
            <li class="menu {{ active('admin/settings', 0) }}">
                <a href="{{ route('settings.edit') }}" aria-expanded="{{ menu_expanded('admin/settings', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-cogs"></i> @lang('admin.sidebar.settings')</span>
                    </div>
                </a>
            </li>
            @endcan
        </ul>

    </nav>

</div>