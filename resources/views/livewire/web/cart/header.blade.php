<div class="dropdown dropdown-cart border-0">
	<a href="javascript:void(0);" class="cart_bt" data-toggle="dropdown">
		<strong>{{ $count }}</strong>
	</a>
	<div class="dropdown-menu dropdown-menu-right">
		<ul>
			@foreach($cart as $item)
			<li>
				<figure>
					<img src="{{ image_exist('/admins/img/products/', $item['product']->image, false, false) }}" alt="{{ $item['product']->name }}" title="{{ $item['product']->name }}" width="50" height="50" class="loaded" data-was-processed="true">
				</figure>
				<strong><span>{{ $item['qty'] }}x {{ $item['product']->name }}</span>${{ number_format($item['price']*$item['qty'], 2, ',', '.') }}</strong>
				<a href="javascript:void(0);" class="action" wire:click="remove('{{ $item['code'] }}')">
					<i class="icon_trash_alt"></i>
				</a>
			</li>
			@endforeach
		</ul>
		<div class="total_drop">
			<div class="clearfix add_bottom_15"><strong>Total</strong><span>${{ number_format($total, 2, ',', '.') }}</span></div>
			<a href="{{ route('web.cart') }}" class="btn_1 outline">View Cart</a>
			<a href="{{ route('web.checkout') }}" class="btn_1 text-white py-2">Checkout</a>
		</div>
	</div>
</div>