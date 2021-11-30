@extends('layouts.web')

@section('title', 'Bakery')

@section('links')
<link href="{{ asset('/web/css/template/home.css') }}" rel="stylesheet">
<link href="{{ asset('/web/css/template/detail-page.css') }}" rel="stylesheet">
{{-- <link href="{{ asset('/admins/vendor/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet"> --}}
{{-- <link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}"> --}}
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
		<div class="col-12">
			<div class="main_title center">
				<span><em></em></span>
				<h2>Categories</h2>
			</div>
			<div class="row">
				@foreach ($categories as $category)
				<div class="col-lg-2 col-md-3 col-sm-4 col-6 my-2">
					<div class="item_version_2">
						<a href="#">
							<figure>
								<span>@if($category->products->count()>99){{ '99+' }}@else{{ $category->products->count() }}@endif</span>
								<img src="{{ asset('/admins/img/categories/categories.jpg') }}" data-src="{{ image_exist('/admins/img/categories/', $category->image, false, false) }}" title="{{ $category->name }}" alt="{{ $category->name }}" class="lazy">
								<div class="info">
									<h3>{{ $category->name }}</h3>
								</div>
							</figure>
						</a>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</section>

<nav class="secondary_nav sticky_horizontal">
	<div class="container">
		<ul id="secondary_nav">
			@foreach ($categories as $category)
			<li class="my-2">
				<a class="list-group-item list-group-item-action" href="#{{ $category->slug }}">{{ $category->name }}</a>
			</li>
			@endforeach
		</ul>
		<span></span>
	</div>
</nav>

<section class="bg_gray margin_detail">
	<div class="container">
		<div class="row">
			<div class="col-xl-7 col-lg-7 col-12 list_menu">
				@foreach($categories as $category)
				<div id="{{ $category->slug }}">
					<h4>{{ $category->name }}</h4>
					<div class="row">
						@foreach ($category->products->where('state', '1') as $product)  
						<div class="col-lg-6 col-md-6 col-12">
							<a class="menu_item modal_product" href="javascript:void(0);" product="{{ $product->slug }}">
								<figure>
									<img src="{{ asset('/admins/img/template/image.jpg') }}" data-src="@if(isset($product->images[0])){{ image_exist('/admins/img/products/', $product->images[0]->image, false, false) }}@else{{ image_exist('/admins/img/template/', 'image.jpg', false, false) }}@endif" title="{{ $product->name }}" alt="{{ $product->name }}" class="lazy">
								</figure>
								<h3>{{ $product->name }}</h3>
								<p>{{ Str::limit($product->description , 33) }}</p>
								@if($product->discount>0)
								<strong><del class="text-danger mr-2">${{ price($product->sizes[0]->pivot->price, $product->discount) }}</del> ${{ price($product->sizes[0]->pivot->price, $product->discount, true) }}</strong>
								@else
								<strong>${{ price($product->sizes[0]->pivot->price, $product->discount) }} </strong>
								@endif
							</a>
						</div>
						@endforeach 
					</div> 
				</div>
				@endforeach
			</div>

			<div class="col-xl-5 col-lg-5 col-12" id="sidebar_fixed">
				<div class="box_order mobile_fixed">
					<div class="head">
						<h3>Order Summary</h3>
						<a href="javascript:void(0);" class="close_panel_mobile"><i class="icon_close"></i></a>
					</div>
					<div class="main">
						<ul id="list-cart" class="list-group clearfix">
							{{-- @forelse($products as $item)
							<li price="{{ $item['price'] }}" qty="{{ $item['qty'] }}" code="{{ $item['code'] }}">
								<a href="javascript:void(0);">{{ $item['qty'] }}x {{ $item['product']->name }} ({{ $item['size']->name }})</a><span>${{ $item['subtotal'] }}</span>
								<ul class="ml-4">
									@foreach($item['complements'] as $complement)
									<li class="mb-0">{{ $complement->name }}</li>
									@endforeach
								</ul>
							</li>
							@empty --}}
							<li class="text-danger text-center font-weight-bold cart-empty my-2">Empty Order</li>
							{{-- @endforelse --}}
						</ul>
						<ul class="clearfix">
							{{-- <li>Subtotal<span subtotal="{{ $subtotal }}" id="subtotal">${{ number_format($subtotal, 2, ",", ".") }}</span></li> --}}
							{{-- <li>Descuento<span discount="{{ $discount }}" percentage="@if(session()->has('coupon')){{ session('coupon')['coupon']->discount }}@else{{ 0 }}@endif" id="discount">-${{ number_format($discount, 2, ",", ".") }}</span></li> --}}
							{{-- <li class="total">Total<span total="{{ $total }}" id="total">${{ number_format($total, 2, ",", ".") }}</span></li> --}}
						</ul>
						<div class="btn_1_mobile">
							<a href="#" class="btn_1 gradient full-width mb_5">Order Now</a>
							{{-- <div class="text-center"><small>No se cobra dinero en estos pasos</small></div> --}}
						</div>
					</div>
				</div>
				<div class="btn_reserve_fixed"><a href="javascript:void(0);" class="btn_1 gradient full-width">View Order</a></div>
			</div>
		</div>
	</div>
</section>

<div id="toTop"></div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/admins/vendor/lazyload/lazyload.min.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('/admins/vendor/owlcarousel/owl.carousel.min.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-sidebar/sticky_sidebar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-kit/sticky-kit.min.js') }}"></script>
{{-- <script src="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script> --}}
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection