@extends('layouts.admin')

@section('title', 'List of Agencies')

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
						<h4>List of Agencies</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">
						@can('agencies.create')
						<div class="text-right">
							<a href="{{ route('agencies.create') }}" class="btn btn-primary">Add</a>
						</div>
						@endcan

						<div class="table-responsive mb-4 mt-4">
							<table class="table table-hover table-export">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Route</th>
										<th>Price</th>
										<th>State</th>
										@if(auth()->user()->can('agencies.edit') || auth()->user()->can('agencies.active') || auth()->user()->can('agencies.deactive') || auth()->user()->can('agencies.delete'))
										<th>Actions</th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach($agencies as $agency)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $agency->name }}</td>
										<td>{{ $agency->route }}</td>
										<td>{{ number_format($agency->price, 2, ',', '.') }}</td>
										<td>{!! state($agency->state) !!}</td>
										@if(auth()->user()->can('agencies.edit') || auth()->user()->can('agencies.active') || auth()->user()->can('agencies.deactive') || auth()->user()->can('agencies.delete'))
										<td>
											<div class="btn-group" role="group">
												@can('agencies.edit')
												<a href="{{ route('agencies.edit', ['agency' => $agency->slug]) }}" class="btn btn-info btn-sm bs-tooltip" title="Edit"><i class="fa fa-edit"></i></a>
												@endcan
												@if($agency->state=='Active')
												@can('agencies.deactive')
												<button type="button" class="btn btn-danger btn-sm bs-tooltip" title="Deactivate" onclick="deactiveAgency('{{ $agency->slug }}')"><i class="fa fa-power-off"></i></button>
												@endcan
												@else
												@can('agencies.active')
												<button type="button" class="btn btn-success btn-sm bs-tooltip" title="Activate" onclick="activeAgency('{{ $agency->slug }}')"><i class="fa fa-check"></i></button>
												@endcan
												@endif
												@can('agencies.delete')
												<button type="button" class="btn btn-danger btn-sm bs-tooltip" title="Remove" onclick="deleteAgency('{{ $agency->slug }}')"><i class="fa fa-trash"></i></button>
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

@can('agencies.deactive')
<div class="modal fade" id="deactiveAgency" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Are you sure you want to disable this agency?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cancel</button>
				<form action="#" method="POST" id="formDeactiveAgency">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">Deactivate</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endcan

@can('agencies.active')
<div class="modal fade" id="activeAgency" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Are you sure you want to activate this agency?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cancel</button>
				<form action="#" method="POST" id="formActiveAgency">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">Activate</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endcan

@can('agencies.delete')
<div class="modal fade" id="deleteAgency" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Are you sure you want to delete this agency?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cancel</button>
				<form action="#" method="POST" id="formDeleteAgency">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-primary">Remove</button>
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