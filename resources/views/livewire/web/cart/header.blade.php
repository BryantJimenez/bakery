<div class="dropdown dropdown-cart border-0">
	<a href="javascript:void(0);" class="cart_bt" data-toggle="dropdown">
		<strong>{{ $count }}</strong>
	</a>
	<div class="dropdown-menu dropdown-menu-right">
		<ul class="cart-header py-2">
			@forelse($cart as $item)
			<li>
				<figure>
					<img src="{{ image_exist('/admins/img/products/', $item['product']->image, false, false) }}" alt="{{ $item['product']->name }}" title="{{ $item['product']->name }}" width="50" height="50" class="loaded" data-was-processed="true">
				</figure>
				<strong>
					<span>{{ $item['qty'] }}x {{ $item['product']->name }}</span>
					@php
					$complements=cartComplements($item['complements']);
					@endphp
					@foreach($complements as $complement)
					<span class="small mb-1">
						<b>{{ $complement['attribute'] }}:</b> 
						@foreach($complement['values'] as $value)
						{{ $value['qty'] }}x {{ $value['name'] }}@if(!$loop->last){{ ', ' }}@endif
						@endforeach
					</span>
					@endforeach
					{{ number_format(($item['price']+$item['complement_price'])*$item['qty'], 2, ',', '.').currencySymbol($currency) }}
				</strong>
			</li>
			@empty
			<li class="px-0">
				<p class="text-danger text-center font-weight-bold my-2">@lang('web.cart.header.empty')</p>
			</li>
			@endforelse
		</ul>
		<div class="total_drop">
			<div class="clearfix add_bottom_15"><strong>@lang('web.cart.header.total')</strong><span>{{ number_format($total, 2, ',', '.').currencySymbol($currency) }}</span></div>
			<a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), route('web.checkout'), [], true) }}" hreflang="{{ app()->getLocale() }}" class="btn_1 text-white py-2">@lang('web.cart.header.button')</a>
		</div>
	</div>
</div>