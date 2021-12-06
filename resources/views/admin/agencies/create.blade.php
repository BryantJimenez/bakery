@extends('layouts.admin')

@section('title', 'Crear Agencia')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Crear Agencia</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('agencies.store') }}" method="POST" class="form" id="formAgency">
							@csrf
							<div class="row">
								<div class="form-group col-12">
									<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
									<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Introduzca un nombre" value="{{ old('name') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Ruta<b class="text-danger">*</b></label>
									<input class="form-control @error('route') is-invalid @enderror" type="text" name="route" required placeholder="Introduzca una ruta" value="{{ old('route') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Precio<b class="text-danger">*</b></label>
									<input class="form-control min-decimal @error('price') is-invalid @enderror" type="text" name="price" required placeholder="Introduzca un precio" value="@if(!is_null(old('price'))){{ old('price') }}@else{{ '0' }}@endif">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Descripción (Opcional)</label>
									<textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Introduzca una descripción" rows="2">{{ old('description') }}</textarea>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="agency">Guardar</button>
										<a href="{{ route('agencies.index') }}" class="btn btn-secondary">Volver</a>
									</div>
								</div> 
							</div>
						</form>
					</div>                                        
				</div>

			</div>
		</div>
	</div>

</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection