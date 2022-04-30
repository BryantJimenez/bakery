@extends('layouts.admin')

@section('title', trans('admin.orders.titles.show'))

@section('links')
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/dt-global_style.css') }}">
@endsection

@section('content')

<div class="row">
	<div class="col-xl-5 col-lg-5 col-md-6 col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">@lang('admin.orders.subtitles.show.user')</h3>
				</div>
				<div class="text-center user-info">
					<img src="{{ image_exist('/admins/img/admins/', $order['user']->photo, true) }}" width="90" height="90" alt="Foto de perfil">
					<p class="mb-0">{{ $order['user']->name." ".$order['user']->lastname }}</p>
				</div>
				<div class="user-info-list">
					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('form.phone.label'):</b> @if(!is_null($order['user']) && !empty($order['user']->phone)){{ $order['user']->phone }}@else{{ $order->phone }}@endif</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('form.email.label'):</b> {{ $order['user']->email }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('form.state.label'):</b> @if(!is_null($order->user()->first())){!! state($order['user']->state) !!}@else{!! '<span class="badge badge-danger">Eliminado</span>' !!}@endif</span>
							</li>
						</ul>
					</div>                                    
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-7 col-lg-7 col-md-6 col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">@lang('admin.orders.subtitles.show.order')</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('form.date.label'):</b> {{ $order->created_at->format("d-m-Y H:i a") }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('form.phone.label'):</b> {{ $order->phone }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('admin.orders.info.qty products'):</b> {{ $order['order_products']->sum('qty') }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('admin.orders.info.total paid'):</b> {{ number_format($order->total, 2, ",", ".").$order['currency']->symbol }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('form.currency.label'):</b> {{ $order['currency']->name }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('form.state.label'):</b> {!! stateOrder($order->state) !!}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('admin.orders.info.type delivery'):</b> {{ typeDelivery($order->type_delivery, 0) }}</span>
							</li>
							@if($order->type_delivery==trans('admin.values_attributes.types_delivery.orders.delivery'))
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('admin.orders.info.address shipping'):</b> {{ $order['shipping']->address }}</span>
							</li>
							@endif
							<li class="contacts-block__item">
								<a href="{{ route('orders.index') }}" class="btn btn-secondary">@lang('form.buttons.back')</a>
							</li>
						</ul>
					</div>                                    
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">@lang('admin.orders.subtitles.show.products')</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<div class="table-responsive">
									<table class="table table-normal table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>@lang('form.product.label')</th>
												<th>@lang('form.price.label')</th>
												<th>@lang('admin.orders.info.qty')</th>
												<th>@lang('admin.orders.info.subtotal')</th>
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
												<td colspan="4" class="text-primary text-uppercase font-weight-bold">@lang('admin.orders.info.shipping')</td>
												<td class="text-primary text-uppercase font-weight-bold">{{ number_format($order->delivery, 2, ",", ".").$order['currency']->symbol }}</td>
											</tr>
											<tr>
												<td colspan="4" class="text-primary text-uppercase font-weight-bold">@lang('admin.orders.info.discount')</td>
												<td class="text-primary text-uppercase font-weight-bold">{{ '-'.number_format($order->discount, 2, ",", ".").$order['currency']->symbol }}</td>
											</tr>
											<tr>
												<td colspan="4" class="text-primary text-uppercase font-weight-bold">@lang('admin.orders.info.total')</td>
												<td class="text-primary text-uppercase font-weight-bold">{{ number_format($order->total, 2, ",", ".").$order['currency']->symbol }}</td>
											</tr>
										</tfooter>
									</table>
								</div>
							</li>
						</ul>
					</div>                                    
				</div>
			</div>
		</div>
	</div>

	@if(!is_null($order['payment']))
	<div class="col-xl-6 col-lg-6 col-md-6 col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">@lang('admin.orders.subtitles.show.payment')</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('form.date.label'):</b> {{ $order['payment']->created_at->format("d-m-Y H:i a") }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('form.payment.label'):</b> {{ methodPayment($order['payment']->method, false) }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('admin.orders.info.reason'):</b> {{ $order['payment']->subject }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('admin.orders.info.subtotal'):</b> {{ number_format($order['payment']->subtotal, 2, ",", ".").$order['currency']->symbol }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('admin.orders.info.shipping'):</b> {{ number_format($order['payment']->delivery, 2, ",", ".").$order['currency']->symbol }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('admin.orders.info.discount'):</b> <b class="text-danger">{{ "-".number_format($order['payment']->discount, 2, ",", ".").$order['currency']->symbol }}</b></span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('admin.orders.info.commission'):</b> <b class="text-danger">{{ "-".number_format($order['payment']->fee, 2, ",", ".").$order['currency']->symbol }}</b></span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('admin.orders.info.balance'):</b> {{ number_format($order['payment']->balance, 2, ",", ".").$order['currency']->symbol }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('form.currency.label'):</b> {{ $order['currency']->name }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('form.state.label'):</b> {!! statePayment($order['payment']->state) !!}</span>
							</li>
						</ul>
					</div>                                    
				</div>
			</div>
		</div>
	</div>
	@endif

	@if(!is_null($order['shipping']))
	<div class="col-xl-6 col-lg-6 col-md-6 col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">@lang('admin.orders.subtitles.show.shipping')</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('form.price.label'):</b> {{ number_format($order->delivery, 2, ",", ".").$order['currency']->symbol }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('form.agency.label'):</b> {{ $order['shipping']['agency']->name }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('form.route.label'):</b> {{ $order['shipping']['agency']->route }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('form.address.label'):</b> {{ $order['shipping']->address }}</span>
							</li>
						</ul>
					</div>                                    
				</div>
			</div>
		</div>
	</div>
	@endif

	@if(!is_null($order['coupon']))
	<div class="col-xl-6 col-lg-6 col-md-6 col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">@lang('admin.orders.subtitles.show.coupon')</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('form.code.label'):</b> {{ $order['coupon']->code }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('form.discount.label'):</b> @if($order['coupon']->type==trans('admin.values_attributes.types.coupons.percentage')){{ number_format($order['coupon']->discount, 0, '', '') }}@else{{ number_format($order['coupon']->discount, 2, ',', '.') }}@endif</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>@lang('form.type.label'):</b> {{ $order['coupon']->type }}</span>
							</li>
						</ul>
					</div>                                    
				</div>
			</div>
		</div>
	</div>
	@endif
</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/table/datatable/datatables.js') }}"></script>
@endsection