@extends('layouts.web')

@section('title', 'Finalizar Compra')

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
		<div class="col-xl-7 col-lg-7 col-12 mb-4">
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
							<input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" required placeholder="Introduzca su apellido" value="{{ old('lastname') }}">
						</div>
						<div class="form-group col-12">
							<label>Email</label>
							<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required placeholder="Introduzca un email" value="{{ old('email') }}">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label>Teléfono</label>
							<input type="text" class="form-control int @error('phone') is-invalid @enderror" name="phone" required placeholder="Introduzca un teléfono" value="{{ old('phone') }}">
						</div>
						@else
						<div class="form-group col-12">
							<label>Nombre Completo</label>
							<input type="text" class="form-control" disabled value="{{ Auth::user()->name." ".Auth::user()->lastname }}">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label>Email</label>
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
							<label class="container_radio">Tarjeta <i class="icon_creditcard"></i>
								<input type="radio" value="1" name="payment" required @if(is_null(old('payment')) || old('payment')==1) checked @endif>
								<span class="checkmark"></span>
							</label>
						</div>

						<div class="col-12">
							<div class="card py-3" id="card-stripe-element"></div>
							<span class="payment-errors text-danger" id="card-errors"></span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-5 col-lg-5 col-12 mt-lg-0" id="sidebar_fixed">
			<livewire:web.cart.card />
		</div>
	</form>
</div>

<div id="toTop"></div>

@endsection

@section('scripts')
{{-- <script type="text/javascript" src="{{ asset('/admins/vendor/lazyload/lazyload.min.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-sidebar/sticky_sidebar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-kit/sticky-kit.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>

<script src="https://js.stripe.com/v3/"></script>
<script>
	var style = {
		base: {
			color: '#32325d',
			lineHeight: '18px',
			fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
			fontSmoothing: 'antialiased',
			fontSize: '16px',
			'::placeholder': {
				color: '#aab7c4'
			}
		},
		invalid: {
			color: '#fa755a',
			iconColor: '#fa755a'
		}
	};

  const stripe = Stripe('pk_test_51IfLYLEjV3ifuikCdVwSvLVClsIaO1XtfD6MKLKXCGbYfh3JKSHDOa4zR4pDZBSTVu7PhUJxboFiWgsG8lgoWH7q002KHykxpV', { locale: '{{ app()->getLocale() }}' }); // Create a Stripe client.
  const elements = stripe.elements(); // Create an instance of Elements.
  const card = elements.create('card', { style: style }); // Create an instance of the card Element.

  card.mount('#card-stripe-element'); // Add an instance of the card Element into the `card-stripe-element` <div>.

  card.on('change', function(event) {
  	var displayError = document.getElementById('card-errors');
  	if (event.error) {
  		displayError.textContent = event.error.message;
  	} else {
  		displayError.textContent = '';
  	}
  });
</script>
@endsection