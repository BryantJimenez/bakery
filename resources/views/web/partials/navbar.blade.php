<header class="header_in clearfix">
    <div class="container">
        <div id="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('/web/img/logo_sticky.svg') }}" width="162" height="35"  title="Logo" alt="Logo" class="logo_sticky">
            </a>
        </div>
        <div class="layer"></div>
        @guest
        <ul id="top_menu">
            <li>
                <livewire:web.cart.header />
            </li>
            <li>
                <a href="{{ route('login') }}" class="login">@lang('web.menu.sign in')</a>
            </li>
        </ul>
        @else
        <ul id="top_menu" class="drop_user">
            <li>
                <livewire:web.cart.header />
            </li>
            <li class="mt-lg-0 mt-1">
                <div class="dropdown user clearfix">
                    <a href="javascript:void(0);" data-toggle="dropdown">
                        <figure>
                            <img src="{{ image_exist('/admins/img/users/', Auth::user()->photo, true) }}" title="{{ Auth::user()->name." ".Auth::user()->lastname }}" alt="{{ Auth::user()->name." ".Auth::user()->lastname }}">
                        </figure>
                        <span>{{ Auth::user()->name." ".Auth::user()->lastname }}</span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-content">
                            <ul>
                                @can('dashboard')
                                <li><a href="{{ route('admin') }}"><i class="icon_cog"></i>@lang('web.menu.dashboard')</a></li>
                                @endcan
                                <li><a href="{{ route('web.profile') }}"><i class="icon_profile"></i>@lang('web.menu.profile')</a></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon_key"></i>@lang('web.menu.logout')</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        @endguest
        <a href="javascript:void(0);" class="open_close">
            <i class="icon_menu"></i><span>@lang('web.menu.menu')</span>
        </a>
        <nav class="main-menu">
            <div id="header_menu">
                <a href="javascript:void(0);" class="open_close">
                    <i class="icon_close"></i><span>@lang('web.menu.menu')</span>
                </a>
                <a href="{{ route('home') }}">
                    <img src="{{ asset('/web/img/logo.svg') }}" width="162" height="35"  title="Logo" alt="Logo">
                </a>
            </div>
            <ul>
                <li>
                    <a href="{{ route('home') }}">@lang('web.menu.home')</a>
                </li>
                <li class="d-lg-none">
                    <a href="{{ route('web.checkout') }}">@lang('web.menu.checkout')</a>
                </li>
            </ul>
        </nav>
    </div>
</header>