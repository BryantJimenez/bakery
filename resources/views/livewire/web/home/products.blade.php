<div class="row">
	<div class="col-lg-3 col-md-4 col-12">
		<div class="card card-menu mb-md-5 mb-4">
			<div class="card-body text-center py-md-5 py-4">
				<span class="h5 text-white great-vibes">@lang('web.home.products.heading')</span>
				<h1 class="text-white noto-serif mb-3">@lang('web.home.products.title')</h1>
				<ul class="pl-0 mb-0">
					<li>
						<a href="javascript:void(0);" class="@if($selected==''){{ 'active' }}@endif" wire:click="category('')">@lang('web.home.products.all')</a>
					</li>
					@foreach($categories as $category)
					<li>
						<a href="javascript:void(0);" class="@if($selected==$category->slug){{ 'active' }}@endif" wire:click="category('{{ $category->slug }}')">{{ $category->name }}</a>
					</li>
					@endforeach
				</ul>
			</div>
		</div>

		<div class="d-flex justify-content-center mb-4">
			<a href="{{ route('web.shop') }}" class="btn btn-outline-primary rounded font-weight-bold px-5">@lang('web.home.products.button')</a>
		</div>
	</div>

	<div class="col-lg-9 col-md-8 col-12">
		<img src="{{ asset('web/img/landing/leaf.svg') }}" width="80" height="80" class="d-md-block d-none">

		<div class="row">
			@foreach($products as $product)
			<div class="col-lg-4 col-md-6 col-sm-6 col-12 product-item">
				<div class="product-wrap">
					<img src="{{ image_exist('/admins/img/products/', $product->image, false, false) }}" class="w-100 h-100 img-fluid" title="{{ $product->name }}" alt="{{ $product->name }}">
					<div class="product-info">
						<h5 class="text-white mb-0">{{ $product->name }}</h5>
						<div class="product-links">
							<a href="javascript:void(0);" @if($product->state!=trans('admin.values_attributes.states.products.not available') && $product->state!=trans('admin.values_attributes.states.products.out of stock')) wire:click="modal('{{ $product->slug }}')" @endif>
								<img src="{{ asset('web/img/landing/cart.svg') }}" width="13" height="12">
							</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>

	<div wire:loading wire:target="category">
		@include("web.partials.landing.livewire_loader")
	</div>

	<div wire:loading wire:target="modal">
		@include("web.partials.landing.livewire_loader")
	</div>

	@include('web.partials.notifications')
</div>