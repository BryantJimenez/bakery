<div class="row">
	@foreach ($categories as $category)
	<div class="col-lg-2 col-md-3 col-sm-4 col-6 my-4">
		<div class="item_version_2">
			<a href="javascript:void(0);" wire:click="products('{{ $category->slug }}')">
				<figure>
					<span class="d-flex align-items-center justify-content-center">@if($category['products']->count()>99){{ '99+' }}@else{{ $category['products']->count() }}@endif</span>
					<img src="{{ image_exist('/admins/img/categories/', $category->image, false, false) }}" title="{{ $category->name }}" alt="{{ $category->name }}">
					<div class="info">
						<h3>{{ $category->name }}</h3>
					</div>
				</figure>
			</a>
		</div>
	</div>
	@endforeach

	<div class="col-12 d-lg-none">
		<livewire:web.cart.card />
	</div>
</div>