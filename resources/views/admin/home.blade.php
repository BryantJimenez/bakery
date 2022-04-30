@extends('layouts.admin')

@section('title', trans('admin.home.title'))

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-xl-5 col-12 mb-3">
						<div class="card bg-dark">
							<div class="card-body">
								<h5 class="card-text text-white font-weight-bold">@lang('admin.home.welcome.title')</h5>
								<h6 class="text-white font-weight-bold">@lang('admin.home.welcome.subtitle')</h6>
							</div>
						</div>
					</div>

					<div class="col-xl-7 col-12">
						<div class="row">
							<div class="col-xl-6 col-md-6 col-sm-6 col-12 mb-3"> 
								<div class="card bg-secondary">
									<div class="card-body">
										<h5 class="card-text text-white text-center font-weight-bold">@lang('admin.home.counters.users')</h5>
										<h2 class="text-white text-center font-weight-bold">{{ $users }}</h2>
									</div>
								</div>
							</div>

							<div class="col-xl-6 col-md-6 col-sm-6 col-12 mb-3"> 
								<div class="card bg-secondary">
									<div class="card-body">
										<h5 class="card-text text-white text-center font-weight-bold">@lang('admin.home.counters.customers')</h5>
										<h2 class="text-white text-center font-weight-bold">{{ $customers }}</h2>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-md-4 col-sm-6 col-12 mb-3"> 
						<div class="card bg-secondary">
							<div class="card-body">
								<h5 class="card-text text-white text-center font-weight-bold">@lang('admin.home.counters.categories')</h5>
								<h2 class="text-white text-center font-weight-bold">{{ $categories }}</h2>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-md-4 col-sm-6 col-12 mb-3"> 
						<div class="card bg-secondary">
							<div class="card-body">
								<h5 class="card-text text-white text-center font-weight-bold">@lang('admin.home.counters.products')</h5>
								<h2 class="text-white text-center font-weight-bold">{{ $products }}</h2>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-md-4 col-sm-6 col-12 mb-3"> 
						<div class="card bg-secondary">
							<div class="card-body">
								<h5 class="card-text text-white text-center font-weight-bold">@lang('admin.home.counters.groups')</h5>
								<h2 class="text-white text-center font-weight-bold">{{ $groups }}</h2>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-md-4 col-sm-6 col-12 mb-3"> 
						<div class="card bg-secondary">
							<div class="card-body">
								<h5 class="card-text text-white text-center font-weight-bold">@lang('admin.home.counters.complements')</h5>
								<h2 class="text-white text-center font-weight-bold">{{ $complements }}</h2>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-md-4 col-sm-6 col-12 mb-3"> 
						<div class="card bg-secondary">
							<div class="card-body">
								<h5 class="card-text text-white text-center font-weight-bold">@lang('admin.home.counters.agencies')</h5>
								<h2 class="text-white text-center font-weight-bold">{{ $agencies }}</h2>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-md-4 col-sm-6 col-12 mb-3"> 
						<div class="card bg-secondary">
							<div class="card-body">
								<h5 class="card-text text-white text-center font-weight-bold">@lang('admin.home.counters.attributes')</h5>
								<h2 class="text-white text-center font-weight-bold">{{ $attributes }}</h2>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-md-4 col-sm-6 col-12 mb-3"> 
						<div class="card bg-secondary">
							<div class="card-body">
								<h5 class="card-text text-white text-center font-weight-bold">@lang('admin.home.counters.coupons')</h5>
								<h2 class="text-white text-center font-weight-bold">{{ $coupons }}</h2>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-md-4 col-sm-6 col-12 mb-3"> 
						<div class="card bg-secondary">
							<div class="card-body">
								<h5 class="card-text text-white text-center font-weight-bold">@lang('admin.home.counters.orders.confirms')</h5>
								<h2 class="text-white text-center font-weight-bold">{{ $orders_confirms }}</h2>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-md-4 col-sm-6 col-12 mb-3"> 
						<div class="card bg-secondary">
							<div class="card-body">
								<h5 class="card-text text-white text-center font-weight-bold">@lang('admin.home.counters.orders.pendings')</h5>
								<h2 class="text-white text-center font-weight-bold">{{ $orders_pendings }}</h2>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-md-4 col-sm-6 col-12 mb-3"> 
						<div class="card bg-secondary">
							<div class="card-body">
								<h5 class="card-text text-white text-center font-weight-bold">@lang('admin.home.counters.payments')</h5>
								<h2 class="text-white text-center font-weight-bold">{{ $payments }}</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection