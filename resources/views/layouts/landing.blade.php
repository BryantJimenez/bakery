<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>

	{{-- <meta name="robots" content="index,follow" />
	<meta property="og:url" content="{{ url()->current() }}" />
	<meta property="og:type" content="@yield('ogtype', 'website')" />
	<meta property="og:title" content="@yield('title')" />
	<meta property="og:description" content="@yield('ogdescription', 'Texto descriptivo de la página.')" />
	<meta property="og:image" content="@yield('ogimage', asset('/web/img/logo.png'))" />
	<meta name="description" content="@yield('ogdescription', 'Texto descriptivo de la página.')">
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="" />
	<meta name="twitter:creator" content="" /> --}}

	<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

	<!-- Google Fonts -->
	<link rel="dns-prefetch" href="https://fonts.gstatic.com">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Noto+Serif:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('/web/font/brandon-text/style.css') }}">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('/web/css/fontawesome/all.min.css') }}">
	<!-- Bootstrap core CSS -->
	<link href="{{ asset('/web/css/bootstrap.css') }}" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="{{ asset('/web/css/landing/style.css') }}" rel="stylesheet">
	<!-- BASE CSS -->
	
	<!-- SPECIFIC CSS -->
	@yield('links')
	@livewireStyles
	<!-- SPECIFIC CSS -->

	<!-- PWA -->
	@laravelPWA
</head>
<body class="goto-here bg-white">
	
	@include('web.partials.landing.navbar')

	@yield('content')

	@include('web.partials.landing.footer')
	
	@include('web.partials.landing.loader')

	<!-- JQuery -->
	<script type="text/javascript" src="{{ asset('/web/js/jquery-3.4.1.min.js') }}"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="{{ asset('/web/js/popper.min.js') }}"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="{{ asset('/web/js/bootstrap.min.js') }}"></script>

	@livewireScripts
	<script src="{{ asset('/lang/translations.js') }}"></script>
	<script type="text/javascript">
		if ('{{ app()->getLocale() }}'=='es') {
			var locale='es';
		} else {
			var locale='en';
		}
		Lang.setLocale('{{ app()->getLocale() }}');
	</script>
	@yield('scripts')

	<!-- Scripts -->
	<script type="text/javascript" src="{{ asset('/web/js/landing/script.js') }}"></script>
	@include('web.partials.notifications')
</body>
</html>