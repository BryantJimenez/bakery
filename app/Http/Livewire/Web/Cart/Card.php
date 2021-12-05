<?php

namespace App\Http\Livewire\Web\Cart;

use Livewire\Component;

class Card extends Component
{
	public $total;

	protected $listeners=['cartCard' => 'mount'];

	public function mount()
	{
		$this->total=0.00;
		if (session()->has('cart')) {
			$cart=session('cart');
			foreach($cart as $item) {
				$this->total+=$item['price']*$item['qty'];
			}
		}
	}

    public function render()
    {
    	$cart=[];
		if (session()->has('cart')) {
			$cart=session('cart');
		}
        return view('livewire.web.cart.card', compact('cart'));
    }
}
