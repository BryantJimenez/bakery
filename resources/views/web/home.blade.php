@extends('layouts.landing')

@section('title', trans('admin.name'))

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<section id="hero" class="d-flex align-items-center">
    <div class="container pt-0">
    	<div class="row">
    		<div class="col-lg-5 col-md-6 col-12 d-flex align-items-center">
    			<div class="w-100 text-md-left text-center z-index-1">
    				<span class="h2 text-white great-vibes mb-3">@lang('web.home.banner.heading')</span>
    				<h1 class="text-white noto-serif mb-4">@lang('web.home.banner.title')</h1>
		      		<a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), route('web.shop'), [], true) }}" hreflang="{{ app()->getLocale() }}" class="btn btn-white rounded">@lang('web.home.banner.button')</a>
    			</div>
    		</div>
    		<div class="col-lg-7 col-md-6 col-12 d-md-flex d-none justify-content-center flex-column">
    			<div class="z-index-1">
    				@foreach($banners as $banner)
    				<img src="{{ image_exist('/admins/img/products/', $banner->image, false, false) }}" class="@if($loop->first){{ 'hero-one' }}@elseif($loop->last){{ 'hero-two' }}@endif">
    				@endforeach
    			</div>

    			<p class="text-white my-3 pl-4 z-index-1">@lang('web.home.banner.text')</p>
    		</div>
    	</div>
    </div>

    <div class="social-media d-flex justify-content-center flex-lg-column flex-row z-index-1">
		<a href="javascript:void(0);" target="_blank" class="d-flex justify-content-center align-items-center m-2">
			<img src="{{ asset('web/img/landing/instagram.svg') }}" width="18" height="18" title="Instagram" alt="Instagram">
		</a>

		<a href="javascript:void(0);" target="_blank" class="d-flex justify-content-center align-items-center m-2">
			<img src="{{ asset('web/img/landing/facebook.svg') }}" width="10" height="18" title="Facebook" alt="Facebook">
		</a>
    </div>

    <img src="{{ asset('web/img/landing/food.svg') }}" class="position-absolute d-sm-block d-none img-food">
</section>

<section id="products">
	<div class="container">
		<livewire:web.home.products />
	</div>
</section>

<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-xl-5 col-lg-6 col-md-6 col-12">
				<span class="h5 great-vibes">@lang('web.home.about.heading')</span>
				<h1 class="noto-serif mb-3">@lang('web.home.about.title')</h1>
				<p class="brandon-text">@lang('web.home.about.paragraphs.one')</p>
				<p class="brandon-text">@lang('web.home.about.paragraphs.two')</p>
			</div>

			<div class="col-xl-7 col-lg-6 col-md-6 col-12">
    			<img src="{{ asset('web/img/landing/about_one.png') }}" class="about-one">
    			<img src="{{ asset('web/img/landing/about_two.png') }}" class="about-two">
    		</div>
		</div>
	</div>

	<div class="shapes">
		<img src="{{ asset('web/img/landing/shapes_one.png') }}" class="shape-one">
		<img src="{{ asset('web/img/landing/shapes_two.png') }}" class="shape-two">
	</div>
</section>

@livewire('web.shop.product-modal')

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection