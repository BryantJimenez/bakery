@extends('layouts.admin')

@section('title', 'List of products')

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
						<h4>List of products</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">
						@can('products.create')
						<div class="text-right">
							<a href="{{ route('products.create') }}" class="btn btn-primary">Add</a>
						</div>
						@endcan

						<div class="table-responsive mb-4 mt-4">
							<table class="table table-hover table-export">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Price</th>
										<th>Category</th>
										<th>State</th>
										@if(auth()->user()->can('products.show') || auth()->user()->can('products.edit') || auth()->user()->can('products.active') || auth()->user()->can('products.deactive') || auth()->user()->can('products.delete'))
										<th>Actions</th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach($products as $product)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td class="d-flex">
											<img src="{{ image_exist('/admins/img/products/', $product->image, false, false) }}" class="rounded-circle mr-2" width="45" height="45" alt="{{ $product->name }}" title="{{ $product->name }}"> {{ $product->name }}
										</td>
										<td>{{ number_format($product->price, 2, ',', '.') }}</td>
										<td>@if(!is_null($product['category'])){{ $product['category']->name }}@else{{ "Not Added" }}@endif</td>
										<td>{!! state($product->state) !!}</td>
										@if(auth()->user()->can('products.show') || auth()->user()->can('products.edit') || auth()->user()->can('products.active') || auth()->user()->can('products.deactive') || auth()->user()->can('products.delete'))
										<td>
											<div class="btn-group" role="group">
												@can('products.show')
												<a href="{{ route('products.show', ['product' => $product->slug]) }}" class="btn btn-primary btn-sm bs-tooltip" title="Show"><i class="fa fa-eye"></i></a>
												@endcan
												@can('products.edit')
												<a href="{{ route('products.edit', ['product' => $product->slug]) }}" class="btn btn-info btn-sm bs-tooltip" title="Edit"><i class="fa fa-edit"></i></a>
												@endcan
												@if($product->state=='Active')
												@can('products.deactive')
												<button type="button" class="btn btn-danger btn-sm bs-tooltip" title="Deactivate" onclick="deactiveProduct('{{ $product->slug }}')"><i class="fa fa-power-off"></i></button>
												@endcan
												@else
												@can('products.active')
												<button type="button" class="btn btn-success btn-sm bs-tooltip" title="Activate" onclick="activeProduct('{{ $product->slug }}')"><i class="fa fa-check"></i></button>
												@endcan
												@endif
												@can('products.delete')
												<button type="button" class="btn btn-danger btn-sm bs-tooltip" title="Remove" onclick="deleteProduct('{{ $product->slug }}')"><i class="fa fa-trash"></i></button>
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

@can('products.deactive')
<div class="modal fade" id="deactiveProduct" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Are you sure you want to disable this product?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cancel</button>
				<form action="#" method="POST" id="formDeactiveProduct">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">Deactivate</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endcan

@can('products.active')
<div class="modal fade" id="activeProduct" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Are you sure you want to activate this product?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cancel</button>
				<form action="#" method="POST" id="formActiveProduct">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">Activate</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endcan

@can('products.delete')
<div class="modal fade" id="deleteProduct" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Are you sure you want to delete this product?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cancel</button>
				<form action="#" method="POST" id="formDeleteProduct">
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