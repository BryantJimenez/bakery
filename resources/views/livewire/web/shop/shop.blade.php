<div class="position-relative pb-4">
	<div class="main_title {{ $align }}">
		<span><em></em></span>
		<h2 class="d-flex align-items-center justify-content-{{ $align }}">
			@if($undo)
			<button class="btn_1 d-flex p-2 mr-3" wire:click="undo('{{ $history }}')">
				<i class="arrow_triangle-left"></i>
			</button>
			@endif
			{{ $title }}
		</h2>
	</div>
	<div class="row">
		@if($view=='categories')
		<div class="col-12">
			@include("livewire.web.shop.categories")
		</div>
		@endif

		@if($view=='products')
		<div class="col-12 mb-4">
			@livewire('web.shop.products', ['category' => $category])
		</div>
		@endif
	</div>

	<div wire:loading wire:target="products">
		@include("web.partials.livewire_loader")
	</div>

	<div wire:loading wire:target="undo">
		@include("web.partials.livewire_loader")
	</div>

	@include('web.partials.notifications')
</div>
