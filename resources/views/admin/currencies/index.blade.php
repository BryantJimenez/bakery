@extends('layouts.admin')

@section('title', trans('admin.currencies.titles.index'))

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
						<h4>@lang('admin.currencies.titles.index')</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">
						@can('currencies.create')
						<div class="text-right">
							<a href="{{ route('currencies.create') }}" class="btn btn-primary">@lang('form.buttons.add')</a>
						</div>
						@endcan

						<div class="table-responsive mb-4 mt-4">
							<table class="table table-hover table-export">
								<thead>
									<tr>
										<th>#</th>
										<th>@lang('form.name.label')</th>
										<th>@lang('form.iso.label')</th>
										<th>@lang('form.symbol.label')</th>
										<th>@lang('form.state.label')</th>
										@if(auth()->user()->can('currencies.edit') || auth()->user()->can('currencies.active') || auth()->user()->can('currencies.deactive') || auth()->user()->can('currencies.delete'))
										<th>@lang('admin.table.actions')</th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach($currencies as $currency)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $currency->name }}</td>
										<td>{{ $currency->iso }}</td>
										<td>{{ $currency->symbol }}</td>
										<td>{!! state($currency->state) !!}</td>
										@if(auth()->user()->can('currencies.edit') || auth()->user()->can('currencies.active') || auth()->user()->can('currencies.deactive') || auth()->user()->can('currencies.delete'))
										<td>
											<div class="btn-group" role="group">
												@can('currencies.edit')
												<a href="{{ route('currencies.edit', ['currency' => $currency->slug]) }}" class="btn btn-info btn-sm bs-tooltip" title="@lang('admin.table.edit')"><i class="fa fa-edit"></i></a>
												@endcan
												@if($currency->state==trans('admin.values_attributes.states.active'))
												@can('currencies.deactive')
												<button type="button" class="btn btn-danger btn-sm bs-tooltip" title="@lang('admin.table.deactivate')" onclick="deactiveCurrency('{{ $currency->slug }}')"><i class="fa fa-power-off"></i></button>
												@endcan
												@else
												@can('currencies.active')
												<button type="button" class="btn btn-success btn-sm bs-tooltip" title="@lang('admin.table.activate')" onclick="activeCurrency('{{ $currency->slug }}')"><i class="fa fa-check"></i></button>
												@endcan
												@endif
												@can('currencies.delete')
												<button type="button" class="btn btn-danger btn-sm bs-tooltip" title="@lang('admin.table.delete')" onclick="deleteCurrency('{{ $currency->slug }}')"><i class="fa fa-trash"></i></button>
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

@can('currencies.deactive')
<div class="modal fade" id="deactiveCurrency" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">@lang('admin.currencies.modals.titles.deactivate')</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">@lang('form.buttons.cancel')</button>
				<form action="#" method="POST" id="formDeactiveCurrency">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">@lang('form.buttons.deactivate')</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endcan

@can('currencies.active')
<div class="modal fade" id="activeCurrency" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">@lang('admin.currencies.modals.titles.activate')</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">@lang('form.buttons.cancel')</button>
				<form action="#" method="POST" id="formActiveCurrency">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">@lang('form.buttons.activate')</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endcan

@can('currencies.delete')
<div class="modal fade" id="deleteCurrency" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">@lang('admin.currencies.modals.titles.delete')</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">@lang('form.buttons.cancel')</button>
				<form action="#" method="POST" id="formDeleteCurrency">
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