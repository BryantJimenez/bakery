<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container">
        <div class="header-container d-flex align-items-center justify-content-between">
            <div class="logo">
                <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), route('home'), [], true) }}" hreflang="{{ app()->getLocale() }}">
                    <img src="{{ asset('/web/img/logo_sticky.svg') }}" width="162" height="35"  title="Logo" alt="Logo" class="logo_sticky">
                </a>
            </div>

            <nav id="navbar" class="navbar pr-4">
                <ul>
                    <li>
                        <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), route('home'), [], true) }}" hreflang="{{ app()->getLocale() }}" class="nav-link active p-0">@lang('web.menu.home')</a>
                    </li>
                    <li>
                        <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), route('web.shop'), [], true) }}" hreflang="{{ app()->getLocale() }}" class="nav-link p-0">@lang('web.menu.shop')</a>
                    </li>
                    <li>
                        <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), route('web.checkout'), [], true) }}" hreflang="{{ app()->getLocale() }}" class="nav-link p-0">@lang('web.menu.checkout')</a>
                    </li>
                    @guest
                    <li>
                        <a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), route('login'), [], true) }}" hreflang="{{ app()->getLocale() }}" class="nav-link p-0">@lang('web.menu.sign in')</a>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0);"  class="nav-link p-0">
                            <span>@lang('web.menu.languages')</span>
                        </a>
                        <ul class="py-2">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $locales)
                            <li class="py-0">
                                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" hreflang="{{ $localeCode }}" rel="alternate">{{ $locales['native'] }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @else
                    <li>
                        <a href="javascript:void(0);" class="font-weight-semibold">@lang('web.menu.points', ['points' => Auth::user()->points])</a>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0);">
                            <figure class="mb-0 mr-2">
                                <img src="{{ image_exist('/admins/img/users/', Auth::user()->photo, true) }}" width="20" height="20" class="rounded-circle" title="{{ Auth::user()->name." ".Auth::user()->lastname }}" alt="{{ Auth::user()->name." ".Auth::user()->lastname }}">
                            </figure>
                            <span>{{ Auth::user()->name." ".Auth::user()->lastname }}</span>
                        </a>
                        <ul class="py-2">
                            @can('dashboard')
                            <li class="py-0">
                                <a href="{{ route('admin') }}" hreflang="{{ app()->getLocale() }}"><i class="icon_cog"></i>@lang('web.menu.dashboard')</a>
                            </li>
                            @endcan
                            <li class="pb-0">
                                <a href="{{ route('web.profile') }}" hreflang="{{ app()->getLocale() }}"><i class="icon_profile"></i>@lang('web.menu.profile')</a>
                            </li>
                            <li class="pb-0">
                                <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon_key"></i>@lang('web.menu.logout')</a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </li>
                    @endguest
                </ul>
                <i class="fa fa-bars mobile-nav-toggle"></i>
            </nav>
        </div>
    </div>
</header>