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