<div>
	<div class="box_order mobile_fixed">
		<div class="head">
			<h3>Resumen del Pedido</h3>
			<a href="javascript:void(0);" class="close_panel_mobile"><i class="icon_close"></i></a>
		</div>
		<div class="main">
			<ul id="list-cart" class="list-group clearfix">
				@forelse($cart as $item)
				<li>
					<div class="d-inline-block">
						<a href="javascript:void(0);" wire:click="remove('{{ $item['code'] }}')">{{ $item['qty'] }}x {{ $item['product']->name }}</a>

						<div class="d-inline-flex ml-2">
							@if($item['qty']>1)
							<button type="button" class="btn btn-sm btn-danger cart-minus d-flex justify-content-center align-items-center p-0 mr-2" wire:click="minus('{{ $item['code'] }}')">
								<i class="fa fa-xs fa-minus"></i>
							</button>
							@endif
							<button type="button" class="btn btn-sm btn-success cart-plus d-flex justify-content-center align-items-center p-0" wire:click="plus('{{ $item['code'] }}')">
								<i class="fa fa-xs fa-plus"></i>
							</button>
						</div>
					</div>
					<span>{{ number_format(($item['price']+$item['complement_price'])*$item['qty'], 2, ',', '.').currencySymbol($currency) }}</span>
					<ul class="ml-4">
						@php
						$complements=cartComplements($item['complements']);
						@endphp
						@foreach($complements as $complement)
						<li class="mb-0">
							<strong>{{ $complement['attribute'] }}:</strong>
							@foreach($complement['values'] as $value)
							{{ $value['qty'] }}x {{ $value['name'] }}@if(!$loop->last){{ ', ' }}@endif
							@endforeach
						</li>
						@endforeach
					</ul>
				</li>
				@empty
				<li class="text-danger text-center font-weight-bold my-2">Pedido Vacío</li>
				@endforelse
			</ul>
			<ul class="clearfix">
				<li class="total">Total<span>{{ number_format($total, 2, ",", ".").currencySymbol($currency) }}</span></li>
			</ul>
			<div class="btn_1_mobile">
				<a href="{{ route('web.checkout') }}" class="btn_1 gradient full-width mb_5">Pedir Ahora</a>
			</div>
		</div>
	</div>
	<div class="btn_reserve_fixed">
		<a href="javascript:void(0);" class="btn_1 gradient full-width">Ver Pedido</a>
	</div>
</div>