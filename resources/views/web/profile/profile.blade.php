@extends('layouts.web')

@section('title', 'Perfil')

@section('links')
<link href="{{ asset('/web/css/template/home.css') }}" rel="stylesheet">
<link href="{{ asset('/web/css/template/order-sign_up.css') }}" rel="stylesheet">
<link href="{{ asset('/web/css/template/detail-page.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/admins/vendor/dropify/dropify.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/custom_dt_html5.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<section class="container my-4">
	<div class="row">
		<div class="col-lg-4 col-md-4 col-12 mb-3">
			<figure>
				<a href="javascript:void(0);" data-effect="mfp-zoom-in">
					<img src="{{ asset('/admins/img/users/usuario.png') }}" data-src="{{ image_exist('/admins/img/users/', Auth::user()->photo, true) }}" width="120" height="120" class="rounded lazy" alt="{{ Auth::user()->name." ".Auth::user()->lastname }}" title="{{ Auth::user()->name." ".Auth::user()->lastname }}">
				</a>
			</figure>
			<div class="detail_page_head clearfix">
				<div class="title">
					<h1>{{ Auth::user()->name." ".Auth::user()->lastname }}</h1>
				</div>
			</div>
			<h6>Email: {{ Auth::user()->email }}</h6>
			@if(!is_null(Auth::user()->phone))
			<h6>Teléfono: {{ Auth::user()->phone }}</h6>
			@endif
			@if(!is_null(Auth::user()->address))
			<h6>Dirección: {{ Auth::user()->address }}</h6>
			@endif
		</div>

		<div class="col-lg-8 col-md-8 col-12">
			<ul class="nav nav-tabs mb-3" id="animateLine" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="animated-underline-shopping-tab" data-toggle="tab" href="#animated-underline-shopping" role="tab" aria-controls="animated-underline-shopping" aria-selected="true">Pedidos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link @if(session('tabs')=="setting"){{ 'active' }}@endif" id="animated-underline-setting-tab" data-toggle="tab" href="#animated-underline-setting" role="tab" aria-controls="animated-underline-setting" aria-selected="@if(session('tabs')=="setting"){{ 'true' }}@else{{ 'false' }}@endif">Ajustes</a>
				</li>
			</ul>

			<div class="tab-content" id="animateLineContent-4">
				<div class="tab-pane fade show active" id="animated-underline-shopping" role="tabpanel" aria-labelledby="animated-underline-shopping-tab">
					<div class="row">
						<div class="col-12">
							@if($orders->count()>0)
							<div class="cart-list pb-3">
								<table class="table table-normal">
									<thead class="thead-primary">
										<tr>
											<th class="py-2">#</th>
											<th class="py-2">Total</th>
											<th class="py-2">Estado</th>
											<th class="py-2">Fecha</th>
											<th class="py-2">Acciones</th>
										</tr>
									</thead>
									<tbody>
										@foreach($orders as $order)
										<tr>
											<td class="py-2">{{ $loop->iteration }}</td>
											<td class="py-2">{{ number_format($order->total, 2, ",", ".").$order['currency']->symbol }}</td>
											<td class="py-2">{!! stateOrder($order->state) !!}</td>
											<td class="py-2">{{ $order->created_at->format('d-m-Y H:i a') }}</td>
											<td class="d-flex justify-content-center py-2">
												<a href="{{ route('web.profile.order', ['order' => $order->id]) }}" class="btn_1 gradient" alt="Ver Pedido" title="Ver Pedido">
													<i class="fa fa-shopping-cart"></i>
												</a>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							@else
							<p class="h4 text-center text-danger py-4">No se ha realizado ningun pedido</p>
							@endif
						</div>
					</div>    
				</div>
				<div class="tab-pane fade @if(session('tabs')=="setting"){{ 'show active' }}@endif" id="animated-underline-setting" role="tabpanel" aria-labelledby="animated-underline-setting-tab">
					<form action="{{ route('web.profile.update') }}" method="POST" class="form" id="formProfile" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="row">

							<div class="col-12">
								<div class="box_order_form">
									<div class="head">
										<div class="title">
											<h3>Información Personal</h3>
										</div>
									</div>
									<div class="main">
										<div class="row">
											<div class="col-12">
												<p>Compos obligatorios (<b class="text-danger">*</b>)</p>
											</div>

											<div class="col-12">
												@include('admin.partials.errors')
											</div>

											<div class="form-group col-lg-6 col-md-6 col-12">
												<label class="col-form-label">Foto (Opcional)</label>
												<input type="file" name="photo" accept="image/*" class="dropify" data-height="110" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ image_exist('/admins/img/users/', Auth::user()->photo, true) }}" />
											</div>

											<div class="form-group col-lg-6 col-md-6 col-12">
												<div class="row">
													<div class="form-group col-12">
														<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
														<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Introduzca un nombre" value="{{ Auth::user()->name }}">
													</div>

													<div class="form-group col-12">
														<label class="col-form-label">Apellido<b class="text-danger">*</b></label>
														<input class="form-control @error('lastname') is-invalid @enderror" type="text" name="lastname" required placeholder="Introduzca un apellido" value="{{ Auth::user()->lastname }}">
													</div>
												</div>
											</div>

											<div class="form-group col-lg-6 col-md-6 col-12">
												<label class="col-form-label">Correo Electrónico</label>
												<input class="form-control" type="email" disabled placeholder="Introduzca un correo electrónico" value="{{ Auth::user()->email }}">
											</div>

											<div class="form-group col-lg-6 col-md-6 col-12">
												<label class="col-form-label">Teléfono<b class="text-danger">*</b></label>
												<input class="form-control int @error('phone') is-invalid @enderror" type="text" name="phone" required placeholder="Introduzca un teléfono" value="{{ Auth::user()->phone }}">
											</div>

											<div class="form-group col-12">
												<label class="col-form-label">Dirección<b class="text-danger">*</b></label>
												<input class="form-control @error('address') is-invalid @enderror" type="text" name="address" placeholder="Introduzca una dirección" value="{{ Auth::user()->address }}">
											</div>

											<div class="form-group col-lg-6 col-md-6 col-12">
												<label class="col-form-label">Contraseña (Opcional)</label>
												<input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="********" id="password">
											</div>

											<div class="form-group col-lg-6 col-md-6 col-12">
												<label class="col-form-label">Confirmar Contraseña (Opcional)</label>
												<input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" placeholder="********">
											</div>

											<div class="form-group col-12">
												<button type="submit" class="btn_1 gradient full-width" action="profile">Actualizar</button>
											</div> 
										</div>	
									</div>
								</div>
							</div>

						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
</section>

<div id="toTop"></div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/admins/vendor/lazyload/lazyload.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/dropify/dropify.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection