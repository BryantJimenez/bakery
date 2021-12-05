@extends('layouts.web')

@section('title', 'Bakery')

@section('links')
<link href="{{ asset('/web/css/template/home.css') }}" rel="stylesheet">
<link href="{{ asset('/web/css/template/detail-page.css') }}" rel="stylesheet">
{{-- <link href="{{ asset('/admins/vendor/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet"> --}}
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<main>
	<div class="hero_single version_2" style="background: #faf3cc url('{{ asset('/web/img/hero_5.svg') }}') center center no-repeat;">
		<div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
			<div class="container">
				<div class="row justify-content-lg-center justify-content-md-center">
					<div class="col-xl-7 col-lg-8">
						<h1 class="text-center">Food delivery or take away</h1>
						<p class="text-center">The best food at the best price</p>
						<form action="#" method="GET">
							<div class="row no-gutters custom-search-input">
								<div class="col-lg-10">
									<div class="form-group">
										<input name="search" class="form-control no_border_r" type="text"  placeholder="What are you going to order today?...">
									</div>
								</div>
								<div class="col-lg-2">
									<button class="btn_1 gradient" type="submit">Search</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="wave hero"></div>
	</div>
</main>

<section class="container">
	<div class="row">
		<div class="col-12 mb-lg-0 mb-4">
			<livewire:web.shop.shop />
		</div>

		<div class="col-12 d-lg-none">
			<livewire:web.cart.card />
		</div>
	</div>
</section>

@livewire('web.shop.product-modal')

<div id="toTop"></div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/admins/vendor/lazyload/lazyload.min.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('/admins/vendor/owlcarousel/owl.carousel.min.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-sidebar/sticky_sidebar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-kit/sticky-kit.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection