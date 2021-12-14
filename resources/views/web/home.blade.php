@extends('layouts.web')

@section('title', 'Bakery')

@section('links')
<link href="{{ asset('/web/css/template/home.css') }}" rel="stylesheet">
<link href="{{ asset('/web/css/template/detail-page.css') }}" rel="stylesheet">
{{-- <link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}"> --}}
<link href="{{ asset('/admins/vendor/mcustomscrollbar/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<section class="container">
	<div class="row">
		<div class="col-12 mb-lg-0 my-4">
			<livewire:web.shop.shop />
		</div>
	</div>
</section>

@livewire('web.shop.product-modal')

<div id="toTop"></div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/mcustomscrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/lazyload/lazyload.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-sidebar/sticky_sidebar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-kit/sticky-kit.min.js') }}"></script>
{{-- <script src="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script> --}}
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection