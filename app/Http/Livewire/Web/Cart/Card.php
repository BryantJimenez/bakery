<?php

namespace App\Http\Livewire\Web\Cart;

use App\Models\Setting;
use App\Traits\CartTrait;
use Livewire\Component;
use Auth;

class Card extends Component
{
	use CartTrait;

	public $total;
	public $currency=NULL;

	protected $listeners=['cartCard' => 'mount'];

	public function mount()
	{
		$setting=Setting::with(['currency'])->first();
		if (!is_null($setting)) {
			$this->currency=$setting['currency'];
		}
		$this->total=$this->calculateCart();
	}

	public function render()
	{
		$cart=$this->getCart();
		return view('livewire.web.cart.card', compact('cart'));
	}

	public function plus($code) {
		if (Auth::check()) {
			$this->plusCartDatabase($code);
		} else {
			if (session()->has('cart')) {
				$this->plusCartSession($code);
			}
		}

		$this->total=$this->calculateCart();
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

		$this->total=$this->calculateCart();
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

		$this->total=$this->calculateCart();
		$this->emit('cartCounterHeader');
	}
}
