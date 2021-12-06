<div>
	<div class="box_order mobile_fixed">
		<div class="head">
			<h3>Resumen del Pedido</h3>
			<a href="javascript:void(0);" class="close_panel_mobile"><i class="icon_close"></i></a>
		</div>
		<div class="main">
			<ul id="list-cart" class="list-group clearfix">
				@forelse($cart as $item)
				<li wire:click="remove('{{ $item['code'] }}')">
					<a href="javascript:void(0);">{{ $item['qty'] }}x {{ $item['product']->name }}</a><span>{{ number_format($item['price']*$item['qty'], 2, ',', '.').currencySymbol($currency) }}</span>
					<ul class="ml-4">
						@foreach($item['complements'] as $complement)
						<li class="mb-0">{{ $complement->name }}</li>
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
	<div class="btn_reserve_fixed"><a href="javascript:void(0);" class="btn_1 gradient full-width">Ver Pedido</a></div>
</div>
