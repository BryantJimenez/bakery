<?php

namespace App\Http\Livewire\Web\Cart;

use Livewire\Component;

class Header extends Component
{
	public $count;
	public $total;

	protected $listeners=['cartCounterHeader' => 'mount'];

	public function mount()
	{
		$counter=0;
		$this->total=0.00;
		if (session()->has('cart')) {
			$counter=count(session('cart'));
			$cart=session('cart');
			foreach($cart as $item) {
				$this->total+=$item['price']*$item['qty'];
			}
		}
		$this->count=$counter;
	}

	public function render()
	{
		$cart=[];
		if (session()->has('cart')) {
			$cart=session('cart');
		}
		return view('livewire.web.cart.header', compact('cart'));
	}

	public function remove() {
        if (session()->has('cart')) {
            $cart=session('cart');

            if (array_search(request('code'), array_column($cart, 'code'))!==false) {
                session()->forget('cart');
                foreach ($cart as $item) {
                    if (request('code')!=$item['code']) {
                        if (!session()->has('cart')) {
                            session()->put('cart', array(0 => $item));
                        } else {
                            session()->push('cart', $item);
                        }
                    }
                }
            }
        }
    }
}
