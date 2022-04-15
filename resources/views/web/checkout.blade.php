@extends('layouts.web')

@section('title', trans('web.checkout.title'))

@section('links')
<link href="{{ asset('/web/css/template/home.css') }}" rel="stylesheet">
<link href="{{ asset('/web/css/template/order-sign_up.css') }}" rel="stylesheet">
<link href="{{ asset('/web/css/template/detail-page.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="container margin_60_20">
	<div class="row">
		<div class="col-xl-7 col-lg-7 col-12 mb-4">
			@guest
			<div class="row">
				<div class="col-lg-6 col-12">
					<div class="box_order_form">
						<div class="head">
							<div class="title">
								<h3>@lang('web.checkout.login.title')</h3>
							</div>
						</div>
						<div class="main">
							<div class="row">
								<div class="col-12">
									<p class="mb-1">@lang('web.checkout.login.description')</p>
									<a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), route('login'), [], true) }}" hreflang="{{ app()->getLocale() }}" class="btn_1 mb-3">@lang('web.checkout.login.button')</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-6 col-12">
					<div class="box_order_form">
						<div class="head">
							<div class="title">
								<h3>@lang('web.checkout.register.title')</h3>
							</div>
						</div>
						<div class="main">
							<div class="row">
								<div class="col-12">
									<p class="mb-1">@lang('web.checkout.login.description')</p>
									<a href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), route('register'), [], true) }}" hreflang="{{ app()->getLocale() }}" class="btn_1 mb-3">@lang('web.checkout.login.button')</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@else
			<form action="{{ route('web.checkout.store') }}" method="POST" id="formCheckout">
				@csrf
				<div class="box_order_form">
					<div class="head">
						<div class="title">
							<h3>@lang('web.checkout.personal details')</h3>
						</div>
					</div>
					<div class="main">
						<div class="row">
							<div class="col-12">
								@include('admin.partials.errors')
							</div>

							<div class="form-group col-12">
								<label>@lang('form.fullname.label')</label>
								<input type="text" class="form-control" disabled value="{{ Auth::user()->name." ".Auth::user()->lastname }}">
							</div>
							<div class="form-group col-lg-6 col-md-6 col-12">
								<label>@lang('form.email.label')</label>
								<input type="email" class="form-control" disabled value="{{ Auth::user()->email }}">
							</div>
							<div class="form-group col-lg-6 col-md-6 col-12">
								<label>@lang('form.phone.label')</label>
								<input type="text" class="form-control int @error('phone') is-invalid @enderror" name="phone" required placeholder="@lang('form.phone.placeholder')" value="{{ Auth::user()->phone }}">
							</div>
						</div>	
					</div>

					<div class="head">
						<div class="title">
							<h3>@lang('web.checkout.shipping.title')</h3>
						</div>
					</div>
					<div class="main">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<label class="container_radio">@lang('form.delivery.options.eat on site')
									<label for="shipping"></label>
									<input type="radio" value="1" name="shipping" required @if(is_null(old('shipping')) || old('shipping')=='1') checked @endif>
									<span class="checkmark"></span>
								</label>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<label class="container_radio">@lang('form.delivery.options.to take away')
									<input type="radio" value="2" name="shipping" required @if(old('shipping')=='2') checked @endif>
									<span class="checkmark"></span>
								</label>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<label class="container_radio">@lang('form.delivery.options.delivery')
									<input type="radio" value="3" name="shipping" required @if(old('shipping')=='3') checked @endif>
									<span class="checkmark"></span>
								</label>
							</div>

							<div class="col-12 @if(old('shipping')!='3') d-none @endif" id="shippingCheckout">
								<div class="row">
									<div class="form-group col-12">
										<label>@lang('web.checkout.shipping.label')</label>
										<select class="form-control @error('agency_id') is-invalid @enderror" name="agency_id" required @if(old('shipping')!='3') disabled @endif>
											<option value="">@lang('form.select.select')</option>
											@foreach($agencies as $agency)
											<option value="{{ $agency->slug }}" @if(old('agency_id')==$agency->slug) selected @endif>{{ "[".number_format($agency->price, 2, ',', '.').$setting['currency']->symbol."] (".$agency->name.") ".$agency->route }}</option>
											@endforeach
										</select>
									</div>

									<div class="form-group col-12">
										<label>@lang('form.full address.label')</label>
										<input type="text" class="form-control @error('address') is-invalid @enderror" name="address" required @if(old('shipping')!='3') disabled @endif placeholder="@lang('form.full address.placeholder')" value="@if(is_null(old('address'))){{ Auth::user()->address }}@else{{ old('address') }}@endif">
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="head">
						<div class="title">
							<h3>@lang('web.checkout.payment')</h3>
						</div>
					</div>
					<div class="main">
						<div class="row">
							@if(!empty($setting->stripe_public) && !is_null($setting->stripe_public) && !empty($setting->stripe_secret) && !is_null($setting->stripe_secret))
							<div class="col-lg-4 col-md-4 col-12">
								<label class="container_radio">@lang('admin.values_attributes.methods.card') <i class="icon_creditcard"></i>
									<input type="radio" value="1" name="payment" required @if(is_null(old('payment')) || old('payment')==1) checked @endif>
									<span class="checkmark"></span>
								</label>
							</div>

							<div class="col-12">
								<div class="card py-3" public="{{ $setting->stripe_public }}" id="card-stripe-element"></div>
								<span class="payment-errors text-danger" id="card-errors"></span>
							</div>
							@endif

							<div class="col-12">
								<button type="submit" class="btn_1 gradient full-width mb_5" action="checkout">@lang('web.checkout.button')</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			@endguest
		</div>

		<div class="col-xl-5 col-lg-5 col-12 mt-lg-0" id="sidebar_fixed">
			<livewire:web.cart.card />
		</div>
	</div>
</div>

<div id="toTop"></div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/admins/vendor/sticky-sidebar/sticky_sidebar.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
<script src="https://js.stripe.com/v3/"></script>
@endsection