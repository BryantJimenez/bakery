@extends('layouts.admin')

@section('title', trans('admin.schedules.titles.index'))

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
						<h4>@lang('admin.schedules.titles.index')</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">
						@can('schedules.create')
						<div class="text-right">
							<a href="{{ route('schedules.create') }}" class="btn btn-primary">@lang('form.buttons.add')</a>
						</div>
						@endcan

						<div class="table-responsive mb-4 mt-4">
							<table class="table table-hover table-export">
								<thead>
									<tr>
										<th>#</th>
										<th>@lang('form.start_time.label')</th>
										<th>@lang('form.end_time.label')</th>
										<th>@lang('form.days.label')</th>
										<th>@lang('form.state.label')</th>
										@if(auth()->user()->can('schedules.edit') || auth()->user()->can('schedules.active') || auth()->user()->can('schedules.deactive') || auth()->user()->can('schedules.delete'))
										<th>@lang('admin.table.actions')</th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach($schedules as $schedule)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $schedule->start->format('h:i A') }}</td>
										<td>{{ $schedule->end->format('h:i A') }}</td>
										<td>
											@foreach($schedule->days as $day)
											@lang('admin.values_attributes.days.'.$day)
											@if(!$loop->last)<br>@endif
											@endforeach
										</td>
										<td>{!! state($schedule->state) !!}</td>
										@if(auth()->user()->can('schedules.edit') || auth()->user()->can('schedules.active') || auth()->user()->can('schedules.deactive') || auth()->user()->can('schedules.delete'))
										<td>
											<div class="btn-group" role="group">
												@can('schedules.edit')
												<a href="{{ route('schedules.edit', ['schedule' => $schedule->id]) }}" class="btn btn-info btn-sm bs-tooltip" title="@lang('admin.table.edit')"><i class="fa fa-edit"></i></a>
												@endcan
												@if($schedule->state==trans('admin.values_attributes.states.active'))
												@can('schedules.deactive')
												<button type="button" class="btn btn-danger btn-sm bs-tooltip" title="@lang('admin.table.deactivate')" onclick="deactiveSchedule('{{ $schedule->id }}')"><i class="fa fa-power-off"></i></button>
												@endcan
												@else
												@can('schedules.active')
												<button type="button" class="btn btn-success btn-sm bs-tooltip" title="@lang('admin.table.activate')" onclick="activeSchedule('{{ $schedule->id }}')"><i class="fa fa-check"></i></button>
												@endcan
												@endif
												@can('schedules.delete')
												<button type="button" class="btn btn-danger btn-sm bs-tooltip" title="@lang('admin.table.delete')" onclick="deleteSchedule('{{ $schedule->id }}')"><i class="fa fa-trash"></i></button>
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

@can('schedules.deactive')
<div class="modal fade" id="deactiveSchedule" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">@lang('admin.schedules.modals.titles.deactivate')</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">@lang('form.buttons.cancel')</button>
				<form action="#" method="POST" id="formDeactiveSchedule">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">@lang('form.buttons.deactivate')</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endcan

@can('schedules.active')
<div class="modal fade" id="activeSchedule" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">@lang('admin.schedules.modals.titles.activate')</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">@lang('form.buttons.cancel')</button>
				<form action="#" method="POST" id="formActiveSchedule">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">@lang('form.buttons.activate')</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endcan

@can('schedules.delete')
<div class="modal fade" id="deleteSchedule" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">@lang('admin.schedules.modals.titles.delete')</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">@lang('form.buttons.cancel')</button>
				<form action="#" method="POST" id="formDeleteSchedule">
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