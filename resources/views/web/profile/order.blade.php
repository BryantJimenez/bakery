@extends('layouts.web')

@section('title', 'Detalles del Pedido')

@section('links')
<link href="{{ asset('/web/css/template/home.css') }}" rel="stylesheet">
<link href="{{ asset('/web/css/template/order-sign_up.css') }}" rel="stylesheet">
<link href="{{ asset('/web/css/template/detail-page.css') }}" rel="stylesheet">
@endsection

@section('content')

<section class="container py-3">
	<div class="row">
		<div class="col-12">
			<div class="box_order_form">
				<div class="head">
					<div class="title">
						<h3>Detalles del Pedido</h3>
					</div>
				</div>
				<div class="main">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<p class="mb-1"><strong>Fecha del pedido:</strong> {{ $order->created_at->format("d-m-Y H:i a") }}</p>
						</div>

						<div class="col-lg-6 col-md-6 col-12">
							<p class="mb-1"><strong>Método de pago:</strong> {{ methodPayment($order['payment']->method, false) }}</p>
						</div>

						<div class="col-lg-6 col-md-6 col-12">
							<p class="mb-1"><strong>Total del pedido:</strong> {{ number_format($order->total, 2, ",", ".").$order['currency']->symbol }}</p>
						</div>

						<div class="col-lg-6 col-md-6 col-12">
							<p class="mb-1"><strong>Tipo de entrega:</strong> {{ $order->type_delivery }}</p>
						</div>

						@if($order->type_delivery=='A Domicilio')
						<div class="col-12">
							<p class="mb-1"><strong>Dirección:</strong> {{ $order['shipping']->address }}</p>
						</div>
						@endif

						<div class="col-lg-6 col-md-6 col-12">
							<p class="mb-1"><strong>Estado del pedido:</strong> {!! stateOrder($order->state) !!}</p>
						</div>

						<div class="col-lg-6 col-md-6 col-12">
							<p class="mb-1"><strong>Estado del pago:</strong> {!! statePayment($order['payment']->state) !!}</p>
						</div>

						<div class="col-12 mt-2">
							<a href="{{ route('web.profile') }}" class="btn_1 gradient">Volver</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="container">
	<div class="row">
		<div class="col-12">
			<div class="box_order_form">
				<div class="head">
					<div class="title">
						<h3>Productos del Pedido</h3>
					</div>
				</div>
				<div class="main">
					<div class="row">
						<div class="col-12">
							<div class="cart-list">
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>Producto</th>
											<th>Precio</th>
											<th>Cantidad</th>
											<th>Subtotal</th>
										</tr>
									</thead>
									<tbody>
										@foreach($order['order_products'] as $item)
										<tr>
											<td>{{ $loop->iteration }}</td>
											<td>
												{{ $item['product']->name }}@if($item['complements']->count()>0)<br>@endif
												@foreach($item['complements'] as $complement)
												{{ $complement->qty.'x '.$complement['complement']->name }}@if(!$loop->last){{ ', ' }}@endif
												@endforeach
											</td>
											<td>{{ number_format($item->price+$item->complement_price, 2, ",", ".").$order['currency']->symbol }}</td>
											<td>{{ $item->qty }}</td>
											<td>{{ number_format($item->subtotal, 2, ",", ".").$order['currency']->symbol }}</td>
										</tr>
										@endforeach
									</tbody>
									<tfooter>
										<tr>
											<td colspan="4" class="text-primary text-left text-uppercase font-weight-bold">Envío</td>
											<td class="text-primary text-uppercase font-weight-bold">{{ number_format($order->delivery, 2, ",", ".").$order['currency']->symbol }}</td>
										</tr>
										<tr>
											<td colspan="4" class="text-primary text-left text-uppercase font-weight-bold">Total</td>
											<td class="text-primary text-uppercase font-weight-bold">{{ number_format($order->total, 2, ",", ".").$order['currency']->symbol }}</td>
										</tr>
									</tfooter>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div id="toTop"></div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/mcustomscrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
@endsection