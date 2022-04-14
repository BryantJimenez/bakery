@extends('layouts.admin')

@section('title', trans('admin.orders.titles.index'))

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/custom_dt_html5.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/dt-global_style.css') }}">
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>@lang('admin.orders.titles.index')</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">

						<div class="table-responsive mb-4 mt-4">
							<table class="table table-hover table-normal">
								<thead>
									<tr>
										<th>#</th>
										<th>@lang('form.user.label')</th>
										<th>@lang('admin.orders.info.total')</th>
										<th>@lang('form.delivery.abbreviation')</th>
										<th>@lang('form.payment.abbreviation')</th>
										<th>@lang('form.state.label')</th>
										<th>@lang('form.date.label')</th>
										@if(auth()->user()->can('orders.show') || auth()->user()->can('orders.active') || auth()->user()->can('orders.deactive'))
										<th>@lang('admin.table.actions')</th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach($orders as $order)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $order['user']->name." ".$order['user']->lastname }}</td>
										<td>{{ number_format($order->total, 2, ",", ".").$order['currency']->symbol }}</td>
										<td>{!! typeDelivery($order->type_delivery) !!}</td>
										<td>{!! statePayment($order->payment->state) !!}</td>
										<td>{!! stateOrder($order->state) !!}</td>
										<td>{{ $order->created_at->format("d-m-Y H:i a") }}</td>
										@if(auth()->user()->can('orders.show') || auth()->user()->can('orders.confirmed') || auth()->user()->can('orders.rejected'))
										<td>
											<div class="btn-group" role="group">
												@can('orders.show')
												<a href="{{ route('orders.show', ['order' => $order->id]) }}" class="btn btn-primary btn-sm bs-tooltip" title="@lang('admin.table.order')"><i class="fa fa-eye"></i></a>
												@endcan
												@if($order->state!=trans('admin.values_attributes.states.orders.rejected'))
												@can('orders.rejected')
												<button type="button" class="btn btn-danger btn-sm bs-tooltip" title="@lang('admin.table.reject')" onclick="rejectedOrder('{{ $order->id }}')"><i class="fa fa-times"></i></button>
												@endcan
												@endif
												@if($order->state!=trans('admin.values_attributes.states.orders.confirmed'))
												@can('orders.confirmed')
												<button type="button" class="btn btn-success btn-sm bs-tooltip" title="@lang('admin.table.confirm')" onclick="confirmedOrder('{{ $order->id }}')"><i class="fa fa-check"></i></button>
												@endcan
												@endif
											</div>
										</td>
										@endif
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>                                        
				</div>

			</div>
		</div>
	</div>

</div>

@can('orders.rejected')
<div class="modal fade" id="rejectedOrder" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">@lang('admin.orders.modals.titles.reject')</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">@lang('form.buttons.cancel')</button>
				<form action="#" method="POST" id="formRejectedOrder">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">@lang('form.buttons.reject')</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endcan

@can('orders.confirmed')
<div class="modal fade" id="confirmedOrder" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">@lang('admin.orders.modals.titles.confirm')</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">@lang('form.buttons.cancel')</button>
				<form action="#" method="POST" id="formConfirmedOrder">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">@lang('form.buttons.confirm')</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endcan

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/jszip.min.js') }}"></script>    
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/buttons.print.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection