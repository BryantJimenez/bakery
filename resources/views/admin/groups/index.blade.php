@extends('layouts.admin')

@section('title', 'List of Groups')

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
						<h4>List of Groups</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">
						@can('groups.create')
						<div class="text-right">
							<a href="{{ route('groups.create') }}" class="btn btn-primary">Add</a>
						</div>
						@endcan

						<div class="table-responsive mb-4 mt-4">
							<table class="table table-hover table-export">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Condition</th>
										<th>Min/Max</th>
										<th>Attribute</th>
										<th>State</th>
										@if(auth()->user()->can('groups.show') || auth()->user()->can('groups.edit') || auth()->user()->can('groups.active') || auth()->user()->can('groups.deactive') || auth()->user()->can('groups.delete'))
										<th>Actions</th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach($groups as $group)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $group->name }}</td>
										<td>{{ $group->condition }}</td>
										<td>{{ $group->min.'/'.$group->max }}</td>
										<td>{{ $group['attribute']->name }}</td>
										<td>{!! state($group->state) !!}</td>
										@if(auth()->user()->can('groups.show') || auth()->user()->can('groups.edit') || auth()->user()->can('groups.active') || auth()->user()->can('groups.deactive') || auth()->user()->can('groups.delete'))
										<td>
											<div class="btn-group" role="group">
												@can('groups.show')
												<a href="{{ route('groups.show', ['group' => $group->slug]) }}" class="btn btn-primary btn-sm bs-tooltip" title="Show"><i class="fa fa-eye"></i></a>
												@endcan
												@can('groups.edit')
												<a href="{{ route('groups.edit', ['group' => $group->slug]) }}" class="btn btn-info btn-sm bs-tooltip" title="Edit"><i class="fa fa-edit"></i></a>
												@endcan
												@can('groups.assign.complements')
												<a href="{{ route('groups.assign', ['group' => $group->slug]) }}" class="btn btn-secondary btn-sm bs-tooltip" title="Assign Complements"><i class="fab fa-dropbox"></i></a>
												@endcan
												@if($group->state=='Active')
												@can('groups.deactive')
												<button type="button" class="btn btn-danger btn-sm bs-tooltip" title="Deactivate" onclick="deactiveGroup('{{ $group->slug }}')"><i class="fa fa-power-off"></i></button>
												@endcan
												@else
												@can('groups.active')
												<button type="button" class="btn btn-success btn-sm bs-tooltip" title="Activate" onclick="activeGroup('{{ $group->slug }}')"><i class="fa fa-check"></i></button>
												@endcan
												@endif
												@can('groups.delete')
												<button type="button" class="btn btn-danger btn-sm bs-tooltip" title="Remove" onclick="deleteGroup('{{ $group->slug }}')"><i class="fa fa-trash"></i></button>
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

@can('groups.deactive')
<div class="modal fade" id="deactiveGroup" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Are you sure you want to disable this group?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cancel</button>
				<form action="#" method="POST" id="formDeactiveGroup">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">Deactivate</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endcan

@can('groups.active')
<div class="modal fade" id="activeGroup" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Are you sure you want to activate this group?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cancel</button>
				<form action="#" method="POST" id="formActiveGroup">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">Activate</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endcan

@can('groups.delete')
<div class="modal fade" id="deleteGroup" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Are you sure you want to delete this group?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cancel</button>
				<form action="#" method="POST" id="formDeleteGroup">
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