@extends('layouts.admin')

@section('title', 'Home')

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-xl-5 col-12 mb-3">
						<div class="card bg-primary">
							<div class="card-body">
								<h5 class="card-text text-white font-weight-bold">Welcome:</h5>
								<h6 class="text-white font-weight-bold">Manage all your business in a simple, easy, comfortable and customized way!</h6>
							</div>
						</div>
					</div>

					<div class="col-xl-7 col-12">
						<div class="row">
							<div class="col-xl-6 col-md-6 col-sm-6 col-12 mb-3"> 
								<div class="card bg-secondary">
									<div class="card-body">
										<h5 class="card-text text-white text-center font-weight-bold">Users</h5>
										<h2 class="text-white text-center font-weight-bold">{{ $users }}</h2>
									</div>
								</div>
							</div>

							<div class="col-xl-6 col-md-6 col-sm-6 col-12 mb-3"> 
								<div class="card bg-secondary">
									<div class="card-body">
										<h5 class="card-text text-white text-center font-weight-bold">Categories</h5>
										<h2 class="text-white text-center font-weight-bold">{{ $categories }}</h2>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection