@extends('layouts.web')

@section('title', 'Checkout')

@section('links')
<link href="{{ asset('/web/css/template/home.css') }}" rel="stylesheet">
<link href="{{ asset('/web/css/template/order-sign_up.css') }}" rel="stylesheet">
<link href="{{ asset('/web/css/template/detail-page.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="container margin_60_20">
	<form action="{{ route('web.checkout.store') }}" method="POST" class="row" id="formCheckout">
		@csrf
		<div class="col-xl-7 col-lg-7 col-12">
			<div class="box_order_form">
				<div class="head">
					<div class="title">
						<h3>Detalles Personales</h3>
					</div>
				</div>
				<div class="main">
					<div class="row">
						@guest
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label>Nombre</label>
							<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required placeholder="Introduzca su nombre" value="{{ old('name') }}">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label>Apellido</label>
							<input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" required placeholder="Introduzca su apellido"value="{{ old('lastname') }}">
						</div>
						<div class="form-group col-12">
							<label>Correo Electrónico</label>
							<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required placeholder="Introduzca un email" @if(session()->has('coupon')) value="{{ session('coupon')['email'] }}" @endif>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label>Cédula</label>
							<input type="text" class="form-control int @error('dni') is-invalid @enderror" name="dni" required placeholder="Introduzca una cédula" value="{{ old('dni') }}">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label>Teléfono</label>
							<input type="text" class="form-control int @error('phone') is-invalid @enderror" name="phone" required placeholder="Introduzca un teléfono" value="{{ old('phone') }}">
						</div>
						@else
						<div class="form-group col-12">
							<label>Nombre y Apellido</label>
							<input type="text" class="form-control" disabled value="{{ Auth::user()->name." ".Auth::user()->lastname }}">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label>Correo Electrónico</label>
							<input type="email" class="form-control" disabled value="{{ Auth::user()->email }}">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label>Teléfono</label>
							<input type="text" class="form-control int @error('phone') is-invalid @enderror" name="phone" required placeholder="Introduzca un teléfono" value="{{ Auth::user()->phone }}">
						</div>
						@endguest
					</div>	
				</div>

				<div class="head">
					<div class="title">
						<h3>Método de Entrega</h3>
					</div>
				</div>
				<div class="main">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<label class="container_radio">Para Llevar
								<input type="radio" value="2" name="shipping" required @if(is_null(old('shipping')) || old('shipping')=='2') checked @endif>
								<span class="checkmark"></span>
							</label>
						</div>
						<div class="col-lg-6 col-md-6 col-12">
							<label class="container_radio">Consumo en el Sitio
								<label for="shipping"></label>
								<input type="radio" value="1" name="shipping" required @if(old('shipping')=='1') checked @endif>
								<span class="checkmark"></span>
							</label>
						</div>
						<div class="col-lg-6 col-md-6 col-12">
							<label class="container_radio">Entrega a Domicilio
								<input type="radio" value="3" name="shipping" required @if(old('shipping')=='3') checked @endif>
								<span class="checkmark"></span>
							</label>
						</div>

						<div class="form-group col-12 @if(old('shipping')!='3') d-none @endif" id="address-checkout">
							<label>Dirección Completa</label>
							<input type="text" class="form-control @error('address') is-invalid @enderror" name="address" required @if(old('shipping')!='3') disabled @endif placeholder="Introduzca una dirección completa" value="{{ old('address') }}">
						</div>
					</div>
				</div>

				<div class="head">
					<div class="title">
						<h3>Método de Pago</h3>
					</div>
				</div>
				<div class="main">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-12">
							<label class="container_radio">Efectivo <i class="icon_wallet"></i>
								<input type="radio" value="1" name="payment" required @if(is_null(old('payment')) || old('payment')==1) checked @endif>
								<span class="checkmark"></span>
							</label>
						</div>
						<div class="col-lg-4 col-md-4 col-12">
							<label class="container_radio">Tarjeta <i class="icon_creditcard"></i>
								<input type="radio" value="2" name="payment" required @if(old('payment')==2) checked @endif>
								<span class="checkmark"></span>
							</label>
						</div>
						<div class="col-lg-4 col-md-4 col-12">
							<label class="container_radio">Transferencia <i class="icon_currency"></i>
								<input type="radio" value="3" name="payment" required @if(old('payment')==3) checked @endif>
								<span class="checkmark"></span>
							</label>
						</div>

						<div class="col-12 mt-2" id="div-coupon">
							@if(!session()->has('coupon'))
							<a href="javascript:void(0);" id="btn-coupon">Agregar cupón de descuento</a>
							<div class="row" style="display: none;" id="card-add-coupon">
								<div class="form-group col-lg-8 col-md-8 col-12">
									<input type="text" class="form-control" name="coupon" placeholder="Introduzca un coupon" id="input-coupon">
									<p class="text-danger font-weight-bold validate-coupon d-none mb-0">Este campo es requerido</p>
									<p class="text-danger font-weight-bold validate-email d-none mb-0">El campo email es requerido</p>
								</div>
								<div class="form-group col-lg-4 col-md-4 col-12">
									<button type="button" class="btn_1 gradient full-width mb_5" id="btn-add-coupon">Agregar</button>
								</div>
							</div>
							@else
							<div class="alert alert-success">
								<p class="mb-1">El cupón de descuendo ha sido agregado</p>
								<a href="javascript:void(0);" id="remove-coupon">Quitar cupón</a>
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-5 col-lg-5 col-12 mt-4 mt-lg-0" id="sidebar_fixed">
			<div class="box_order mobile_fixed">
				<div class="head">
					<h3>Resumen del pedido</h3>
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
						<li class="text-danger text-center font-weight-bold cart-empty my-2">Pedido Vacio</li>
						{{-- @endforelse --}}
					</ul>
					<ul class="clearfix">
						{{-- <li>Subtotal<span subtotal="{{ $subtotal }}" id="subtotal">${{ number_format($subtotal, 2, ",", ".") }}</span></li> --}}
						{{-- <li>Descuento<span discount="{{ $discount }}" percentage="@if(session()->has('coupon')){{ session('coupon')['coupon']->discount }}@else{{ 0 }}@endif" id="discount">-${{ number_format($discount, 2, ",", ".") }}</span></li> --}}
						{{-- <li class="total">Total<span total="{{ $total }}" id="total">${{ number_format($total, 2, ",", ".") }}</span></li> --}}
					</ul>

					<button type="submit" class="btn_1 gradient full-width mb_5" {{-- @if(count($products)==0) disabled @endif --}} action="checkout">Finalizar Compra</button>
					{{-- @if(!is_null($setting->phone) && !empty($setting->phone))
					<div class="text-center">
						<small>O llámanos al <strong>{{ $setting->phone }}</strong></small>
					</div>
					@endif --}}
				</div>
			</div>
		</div>

	</form>
</div>

<div id="toTop"></div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/admins/vendor/lazyload/lazyload.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-sidebar/sticky_sidebar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-kit/sticky-kit.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection