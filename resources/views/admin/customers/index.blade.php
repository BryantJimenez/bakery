@extends('layouts.admin')

@section('title', trans('admin.customers.titles.index'))

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
						<h4>@lang('admin.customers.titles.index')</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">
						@can('customers.create')
						<div class="text-right">
							<a href="{{ route('customers.create') }}" class="btn btn-primary">@lang('form.buttons.add')</a>
						</div>
						@endcan

						<div class="table-responsive mb-4 mt-4">
							<table class="table table-hover table-export">
								<thead>
									<tr>
										<th>#</th>
										<th>@lang('form.fullname.label')</th>
										<th>@lang('form.email.label')</th>
										<th>@lang('form.state.label')</th>
										@if(auth()->user()->can('customers.show') || auth()->user()->can('customers.edit') || auth()->user()->can('customers.active') || auth()->user()->can('customers.deactive') || auth()->user()->can('customers.delete'))
										<th>@lang('admin.table.actions')</th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach($customers as $customer)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td class="d-flex">
											<img src="{{ image_exist('/admins/img/users/', $customer->photo, true) }}" class="rounded-circle mr-2" width="45" height="45" alt="{{ $customer->name." ".$customer->lastname }}" title="{{ $customer->name." ".$customer->lastname }}"> {{ $customer->name." ".$customer->lastname }}
										</td>
										<td>{{ $customer->email }}</td>
										<td>{!! state($customer->state) !!}</td>
										@if(auth()->user()->can('customers.show') || auth()->user()->can('customers.edit') || auth()->user()->can('customers.active') || auth()->user()->can('customers.deactive') || auth()->user()->can('customers.delete'))
										<td>
											<div class="btn-group" role="group">
												@can('customers.show')
												<a href="{{ route('customers.show', ['customer' => $customer->slug]) }}" class="btn btn-primary btn-sm bs-tooltip" title="@lang('admin.table.profile')"><i class="fa fa-user"></i></a>
												@endcan
												@can('customers.edit')
												<a href="{{ route('customers.edit', ['customer' => $customer->slug]) }}" class="btn btn-info btn-sm bs-tooltip" title="@lang('admin.table.edit')"><i class="fa fa-edit"></i></a>
												@endcan
												@if($customer->state==trans('admin.values_attributes.states.active'))
												@can('customers.deactive')
												<button type="button" class="btn btn-warning btn-sm bs-tooltip" title="@lang('admin.table.deactivate')" onclick="deactiveCustomer('{{ $customer->slug }}')"><i class="fa fa-power-off"></i></button>
												@endcan
												@else
												@can('customers.active')
												<button type="button" class="btn btn-success btn-sm bs-tooltip" title="@lang('admin.table.activate')" onclick="activeCustomer('{{ $customer->slug }}')"><i class="fa fa-check"></i></button>
												@endcan
												@endif
												@can('customers.delete')
												<button type="button" class="btn btn-danger btn-sm bs-tooltip" title="@lang('admin.table.delete')" onclick="deleteCustomer('{{ $customer->slug }}')"><i class="fa fa-trash"></i></button>
												@endcan
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

@can('customers.deactive')
<div class="modal fade" id="deactiveCustomer" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">@lang('admin.customers.modals.titles.deactivate')</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">@lang('form.buttons.cancel')</button>
				<form action="#" method="POST" id="formDeactiveCustomer">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">@lang('form.buttons.deactivate')</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endcan

@can('customers.active')
<div class="modal fade" id="activeCustomer" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">@lang('admin.customers.modals.titles.activate')</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">@lang('form.buttons.cancel')</button>
				<form action="#" method="POST" id="formActiveCustomer">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">@lang('form.buttons.activate')</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endcan

@can('customers.delete')
<div class="modal fade" id="deleteCustomer" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">@lang('admin.customers.modals.titles.delete')</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">@lang('form.buttons.cancel')</button>
				<form action="#" method="POST" id="formDeleteCustomer">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-primary">@lang('form.buttons.delete')</button>
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