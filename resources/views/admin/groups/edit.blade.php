@extends('layouts.admin')

@section('title', 'Editar Grupo')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
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
						<h4>Editar Grupo</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('groups.update', ['group' => $group->slug]) }}" method="POST" class="form" id="formGroup">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
									<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Introduzca un nombre" value="{{ $group->name }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Condición<b class="text-danger">*</b></label>
									<select class="form-control @error('condition') is-invalid @enderror" name="condition" required>
										<option value="1" @if($group->condition=="Obligatorio") selected @endif>Obligatorio</option>
										<option value="0" @if($group->condition=="Opcional") selected @endif>Opcional</option>
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Mínimo<b class="text-danger">*</b></label>
									<input class="form-control int-max-100 @error('min') is-invalid @enderror" type="text" name="min" required placeholder="Introduzca un mínimo" value="{{ $group->min }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Máximo<b class="text-danger">*</b></label>
									<input class="form-control int-max-100 @error('max') is-invalid @enderror" type="text" name="max" required placeholder="Introduzca un máximo" value="{{ $group->max }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Atributo<b class="text-danger">*</b></label>
									<select class="form-control @error('attribute_id') is-invalid @enderror" name="attribute_id">
										<option value="">Seleccione</option>
										@foreach($attributes as $attribute)
										<option value="{{ $attribute->slug }}" @if($group->attribute_id==$attribute->id) selected @endif>{{ $attribute->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Estado<b class="text-danger">*</b></label>
									<select class="form-control @error('state') is-invalid @enderror" name="state" required>
										<option value="1" @if($group->state=="Activo") selected @endif>Activo</option>
										<option value="0" @if($group->state=="Inactivo") selected @endif>Inactivo</option>
									</select>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="group">Actualizar</button>
										<a href="{{ route('groups.index') }}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection