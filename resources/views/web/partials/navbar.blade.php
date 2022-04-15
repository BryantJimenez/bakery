<header class="header_in clearfix">
    <div class="container">
        <div id="logo">
            <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), route('home'), [], true) }}" hreflang="{{ app()->getLocale() }}">
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
                <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), route('login'), [], true) }}" hreflang="{{ app()->getLocale() }}" class="login">@lang('web.menu.sign in')</a>
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
                                <li>
                                    <a href="{{ route('admin') }}"><i class="icon_cog"></i>@lang('web.menu.dashboard')</a>
                                </li>
                                @endcan
                                <li>
                                    <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), route('web.profile'), [], true) }}" hreflang="{{ app()->getLocale() }}"><i class="icon_profile"></i>@lang('web.menu.profile')</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon_key"></i>@lang('web.menu.logout')</a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li class="">
                <div class="dropdown user languages clearfix">
                    <a href="javascript:void(0);" class="dropdown-toggle" id="dropdownMenuLanguages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-globe"></i></a>
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-content">
                            <ul>
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $locales)
                                <li>
                                    <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" hreflang="{{ $localeCode }}" rel="alternate">{{ $locales['native'] }}</a>
                                </li>
                                @endforeach
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
                <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), route('home'), [], true) }}" hreflang="{{ app()->getLocale() }}">
                    <img src="{{ asset('/web/img/logo.svg') }}" width="162" height="35"  title="Logo" alt="Logo">
                </a>
            </div>
            <ul>
                <li>
                    <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), route('home'), [], true) }}" hreflang="{{ app()->getLocale() }}">@lang('web.menu.home')</a>
                </li>
                <li class="d-lg-none">
                    <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), route('web.checkout'), [], true) }}" hreflang="{{ app()->getLocale() }}">@lang('web.menu.checkout')</a>
                </li>
            </ul>
        </nav>
    </div>
</header>