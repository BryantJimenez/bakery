<div class="row">
	<div class="col-lg-7 col-12 list_menu">
		<div class="row position-relative">
			@if($products->count()>0)
			<div class="col-12">
				<p>Elige un tipo de {{ $category_name }}</p>
			</div>
			@endif

			@forelse($products as $product)
			<div class="col-12">
				<a class="menu_item modal_product" href="javascript:void(0);" @if($product->state!='Not Available' && $product->state!='Out of Stock') wire:click="modal('{{ $product->slug }}')" @endif>
					<figure>
						<img src="{{ image_exist('/admins/img/products/', $product->image, false, false) }}" title="{{ $product->name }}" alt="{{ $product->name }}">
					</figure>
					<h3>{{ $product->name }}</h3>
					<p class="mb-0">{{ Str::limit($product->description , 50) }}</p>
					<p class="mb-0">
						@if($product['groups']->count()>0)
						<span class="text-dark">Tu puedes elegir:</span>
						<br>
						@endif
						@foreach($product['groups'] as $group)
						<b>{{ $group->max }}</b> {{ $group['attribute']->name }}@if(!$loop->last){{ ", " }}@endif
						@endforeach
					</p>
					<strong>{{ number_format($product->price, 2, ',', '.').currencySymbol($currency) }}</strong>

					@if($product->state=='Not Available' || $product->state=='Out of Stock')
					<span class="badge badge-pill badge-danger font-weight-normal position-absolute px-2 py-1">No Disponible</span>
					@endif
				</a>
			</div>
			@empty
			<div class="col-12">
				<p class="h4 text-danger py-4">No hay productos, intenta cambiar de categoría</p>
			</div>
			@endforelse

			<div wire:loading wire:target="modal">
				@include("web.partials.livewire_loader")
			</div>

			<div wire:loading wire:target="previousPage">
				@include("web.partials.livewire_loader")
			</div>

			<div wire:loading wire:target="gotoPage">
				@include("web.partials.livewire_loader")
			</div>

			<div wire:loading wire:target="nextPage">
				@include("web.partials.livewire_loader")
			</div>
		</div>

		@if(!empty($products))
		{{ $products->links() }}
		@endif
	</div>

	<div class="col-lg-5 col-12 mt-lg-0" id="sidebar_fixed">
		<livewire:web.cart.card />
	</div>
</div>