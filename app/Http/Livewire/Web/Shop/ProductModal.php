<?php

namespace App\Http\Livewire\Web\Shop;

use App\Models\Product;
use Livewire\Component;

class ProductModal extends Component
{
	public $show=false;
	public $product=NULL;
	public $price=0.00;
	public $groups=[];
	public $steps=0;
	public $current=0;
	public $finish=false;

	protected $listeners=['productModal' => 'open'];

	public function render()
	{
		return view('livewire.web.shop.product-modal');
	}

	public function open($product) {
		$product=Product::with(['category', 'groups.complements'])->where('slug', $product)->first();
		$this->product=$product;
		$this->price=$product->price;
		$this->groups=$product['groups'];
		$this->steps=$product['groups']->count();
		$this->current=0;
		$this->show=true;
		if ($this->current==$this->steps) {
			$this->finish=true;
		}
	}

	public function close() {
		$this->show=false;
	}

	public function next() {
		if (($this->current+1)==$this->steps) {
			$this->finish=true;
			$this->close();
		} else {
			$this->current++;
		}
	}

	public function cartAdd() {
		// if (!is_null($this->product)) {
			$price=$this->product->price;
			$code=$this->product->slug;

			$complements=[];
			$complementPrice=0;
			// if (!is_null(request('complements')) && !empty(request('complements'))) {
			// 	$num=0;
			// 	foreach (request('complements') as $value) {
			// 		$complement=Complement::where('slug', $value['complement'])->first();
			// 		if (!is_null($complement)) {
			// 			$code.="-".$complement->slug;
			// 			$complements[$num]=$complement;
			// 			$complementPrice+=$complement->price;
			// 			$num++;
			// 		}
			// 	}
			// }

			if (session()->has('cart')) {
				$cart=session('cart');

				if (array_search($code, array_column($cart, 'code'))!==false) {
					$key=array_search($code, array_column($cart, 'code'));
					$cart[$key]['product']=$this->product;
					$cart[$key]['complements']=$complements;
					$cart[$key]['qty']=$cart[$key]['qty']+1;
					
					$subtotal=($price+$complementPrice)*$cart[$key]['qty'];
					$cart[$key]['price']=$price+$complementPrice;
					
					$cart[$key]['subtotal']=number_format($subtotal, 2, ',', '.');
					session()->put('cart', $cart);
				}
			}

			if (!session()->has('cart') || (session()->has('cart') && array_search($code, array_column(session('cart'), 'code'))===false)) {
				$qty=1;
				
				$subtotal=($price+$complementPrice)*$qty;
				$price=$price+$complementPrice;

				$data=array('product' => $this->product, 'complements' => $complements, 'qty' => $qty, 'subtotal' => number_format($subtotal, 2, ',', '.'), 'price' => $price, 'code' => $code);
				session()->push('cart', $data);
			}
		// }

		$this->emit('cartCounterHeader');
		$this->emit('cartCard');
		$this->close();
	}
}
