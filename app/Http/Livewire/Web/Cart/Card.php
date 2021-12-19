<?php

namespace App\Http\Livewire\Web\Cart;

use App\Models\Agency;
use App\Models\Setting;
use App\Traits\CartTrait;
use Livewire\Component;
use Auth;

class Card extends Component
{
	use CartTrait;

	public $subtotal=0.00;
	public $delivery=0.00;
	public $total=0.00;
	public $currency=NULL;

	protected $listeners=['cartCard' => 'mount', 'cartDelivery' => 'delivery'];

	public function mount()
	{
		$setting=Setting::with(['currency'])->first();
		if (!is_null($setting)) {
			$this->currency=$setting['currency'];
		}
		$this->subtotal=$this->calculateCart();
		$this->total=$this->subtotal+$this->delivery;
	}

	public function render()
	{
		$cart=$this->getCart();
		return view('livewire.web.cart.card', compact('cart'));
	}

	public function delivery($agency) {
		$agency=Agency::where([['slug', $agency], ['state', '1']])->first();
		if (!is_null($agency)) {
			$this->delivery=$agency->price;
		} else {
			$this->delivery=0.00;
		}
		$this->mount();
	}

	public function plus($code) {
		if (Auth::check()) {
			$this->plusCartDatabase($code);
		} else {
			if (session()->has('cart')) {
				$this->plusCartSession($code);
			}
		}

		$this->subtotal=$this->calculateCart();
		$this->total=$this->subtotal+$this->delivery;
		$this->emit('cartCounterHeader');
	}

	public function minus($code) {
		if (Auth::check()) {
			$this->minusCartDatabase($code);
		} else {
			if (session()->has('cart')) {
				$this->minusCartSession($code);
			}
		}

		$this->subtotal=$this->calculateCart();
		$this->total=$this->subtotal+$this->delivery;
		$this->emit('cartCounterHeader');
	}

	public function remove($code) {
		if (Auth::check()) {
			$this->removeCartDatabase($code);
		} else {
			if (session()->has('cart')) {
				$this->removeCartSession($code);
			}
		}

		$this->subtotal=$this->calculateCart();
		$this->total=$this->subtotal+$this->delivery;
		$this->emit('cartCounterHeader');
	}
}
