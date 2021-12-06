<div class="dropdown dropdown-cart border-0">
	<a href="javascript:void(0);" class="cart_bt" data-toggle="dropdown">
		<strong>{{ $count }}</strong>
	</a>
	<div class="dropdown-menu dropdown-menu-right">
		<ul>
			@forelse($cart as $item)
			<li>
				<figure>
					<img src="{{ image_exist('/admins/img/products/', $item['product']->image, false, false) }}" alt="{{ $item['product']->name }}" title="{{ $item['product']->name }}" width="50" height="50" class="loaded" data-was-processed="true">
				</figure>
				<strong><span>{{ $item['qty'] }}x {{ $item['product']->name }}</span>{{ number_format($item['price']*$item['qty'], 2, ',', '.').currencySymbol($currency) }}</strong>
			</li>
			@empty
			<li class="px-0">
				<p class="text-danger text-center font-weight-bold my-2">Pedido Vacío</p>
			</li>
			@endforelse
		</ul>
		<div class="total_drop">
			<div class="clearfix add_bottom_15"><strong>Total</strong><span>{{ number_format($total, 2, ',', '.').currencySymbol($currency) }}</span></div>
			<a href="{{ route('web.checkout') }}" class="btn_1 text-white py-2">Finalizar Compra</a>
		</div>
	</div>
</div>