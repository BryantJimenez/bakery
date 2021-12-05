<div>
	<div class="box_order mobile_fixed">
		<div class="head">
			<h3>Order Summary</h3>
			<a href="javascript:void(0);" class="close_panel_mobile"><i class="icon_close"></i></a>
		</div>
		<div class="main">
			<ul id="list-cart" class="list-group clearfix">
				@forelse($cart as $item)
				<li price="{{ $item['price'] }}" qty="{{ $item['qty'] }}" code="{{ $item['code'] }}">
					<a href="javascript:void(0);">{{ $item['qty'] }}x {{ $item['product']->name }}</a><span>${{ number_format($item['price']*$item['qty'], 2, ',', '.') }}</span>
					<ul class="ml-4">
						@foreach($item['complements'] as $complement)
						<li class="mb-0">{{ $complement->name }}</li>
						@endforeach
					</ul>
				</li>
				@empty
				<li class="text-danger text-center font-weight-bold cart-empty my-2">Empty Order</li>
				@endforelse
			</ul>
			<ul class="clearfix">
				<li class="total">Total<span>${{ number_format($total, 2, ",", ".") }}</span></li>
			</ul>
			<div class="btn_1_mobile">
				<a href="javascript:void(0);" class="btn_1 gradient full-width mb_5">Order Now</a>
			</div>
		</div>
	</div>
	<div class="btn_reserve_fixed"><a href="javascript:void(0);" class="btn_1 gradient full-width">View Order</a></div>
</div>
