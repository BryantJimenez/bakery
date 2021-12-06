@extends('layouts.admin')

@section('title', 'Inicio')

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-xl-5 col-12 mb-3">
						<div class="card bg-dark">
							<div class="card-body">
								<h5 class="card-text text-white font-weight-bold">Bienvenido:</h5>
								<h6 class="text-white font-weight-bold">Administre todo su negocio de forma simple, fácil, comoda y a medida!</h6>
							</div>
						</div>
					</div>

					<div class="col-xl-7 col-12">
						<div class="row">
							<div class="col-xl-6 col-md-6 col-sm-6 col-12 mb-3"> 
								<div class="card bg-secondary">
									<div class="card-body">
										<h5 class="card-text text-white text-center font-weight-bold">Usuarios</h5>
										<h2 class="text-white text-center font-weight-bold">{{ $users }}</h2>
									</div>
								</div>
							</div>

							<div class="col-xl-6 col-md-6 col-sm-6 col-12 mb-3"> 
								<div class="card bg-secondary">
									<div class="card-body">
										<h5 class="card-text text-white text-center font-weight-bold">Clientes</h5>
										<h2 class="text-white text-center font-weight-bold">{{ $customers }}</h2>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-md-4 col-sm-6 col-12 mb-3"> 
						<div class="card bg-secondary">
							<div class="card-body">
								<h5 class="card-text text-white text-center font-weight-bold">Categorías</h5>
								<h2 class="text-white text-center font-weight-bold">{{ $categories }}</h2>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-md-4 col-sm-6 col-12 mb-3"> 
						<div class="card bg-secondary">
							<div class="card-body">
								<h5 class="card-text text-white text-center font-weight-bold">Productos</h5>
								<h2 class="text-white text-center font-weight-bold">{{ $products }}</h2>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-md-4 col-sm-6 col-12 mb-3"> 
						<div class="card bg-secondary">
							<div class="card-body">
								<h5 class="card-text text-white text-center font-weight-bold">Grupos</h5>
								<h2 class="text-white text-center font-weight-bold">{{ $groups }}</h2>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-md-4 col-sm-6 col-12 mb-3"> 
						<div class="card bg-secondary">
							<div class="card-body">
								<h5 class="card-text text-white text-center font-weight-bold">Complementos</h5>
								<h2 class="text-white text-center font-weight-bold">{{ $complements }}</h2>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-md-4 col-sm-6 col-12 mb-3"> 
						<div class="card bg-secondary">
							<div class="card-body">
								<h5 class="card-text text-white text-center font-weight-bold">Agencias</h5>
								<h2 class="text-white text-center font-weight-bold">{{ $agencies }}</h2>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-md-4 col-sm-6 col-12 mb-3"> 
						<div class="card bg-secondary">
							<div class="card-body">
								<h5 class="card-text text-white text-center font-weight-bold">Atributos</h5>
								<h2 class="text-white text-center font-weight-bold">{{ $attributes }}</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection