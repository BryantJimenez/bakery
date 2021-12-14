<?php

namespace App\Traits;

use App\Models\Cart\Cart;
use App\Models\Cart\CartProduct;
use App\Models\Cart\CartComplement;
use App\Models\Group\ComplementGroup;
use Illuminate\Http\Request;
use Auth;

trait CartTrait {
	public function getCart() {
		if (Auth::check()) {
			$cart=Cart::with(['products.product', 'products.complements.complement', 'products.complements.group'])->where('user_id', Auth::id())->first();
			$cart=$cart['products']->map(function($product) {
				$complements=$product['complements']->map(function($complement) {
					$complement_group=ComplementGroup::with(['complement', 'group.attribute'])->where([['complement_id', $complement->complement_id], ['group_id', $complement->group_id]])->first();
					return $complement_group;
				});

				$data=array('product' => $product['product'], 'complements' => $complements, 'qty' => $product->qty, 'subtotal' => number_format($product->subtotal, 2, ',', '.'), 'price' => $product->price, 'complement_price' => $product->complement_price, 'code' => $product->code);
				return $data;
			});

			return $cart;
		}
		
		$cart=[];
		if (session()->has('cart')) {
			$cart=session('cart');
		}
		return $cart;
	}

	public function addCart($product, $extras) {
		$code=$product->slug;
		$complements=[];
		$complementPrice=0;

		if (is_array($extras) && !empty($extras)) {
			$num=0;
			foreach ($extras as $value) {
				if (is_array($value)) {
					foreach ($value as $data) {
						$complement_group=ComplementGroup::with(['complement', 'group.attribute'])->where('id', $data)->first();
						if (!is_null($complement_group)) {
							$code.="-".$complement_group['complement']->slug;
							$complements[$num]=$complement_group;
							$complementPrice+=$complement_group->price;
							$num++;
						}
					}
				} else {
					$complement_group=ComplementGroup::with(['complement', 'group.attribute'])->where('id', $value)->first();
					if (!is_null($complement_group)) {
						$code.="-".$complement_group['complement']->slug;
						$complements[$num]=$complement_group;
						$complementPrice+=$complement_group->price;
						$num++;
					}
				}
			}
		}

		if (Auth::check()) {
			$cart=Cart::where('user_id', Auth::id())->first();
			$cart_product=$this->addCartDatabase($cart, $product, $code, $complements, $complementPrice);
			return $cart_product;
		} else {
			$this->addCartSession($product, $code, $complements, $complementPrice);
		}
	}

	public function addCartSession($product, $code, $complements, $complementPrice, $qty=1) {
		if (session()->has('cart')) {
			$cart=session('cart');

			if (array_search($code, array_column($cart, 'code'))!==false) {
				$key=array_search($code, array_column($cart, 'code'));
				$cart[$key]['product']=$product;
				$cart[$key]['complements']=$complements;
				$cart[$key]['qty']=$cart[$key]['qty']+$qty;

				$subtotal=($product->price+$complementPrice)*$cart[$key]['qty'];
				$cart[$key]['price']=$product->price;
				$cart[$key]['complement_price']=$complementPrice;

				$cart[$key]['subtotal']=number_format($subtotal, 2, ',', '.');
				session()->put('cart', $cart);
			}
		}

		if (!session()->has('cart') || (session()->has('cart') && array_search($code, array_column(session('cart'), 'code'))===false)) {
			$subtotal=($product->price+$complementPrice)*$qty;
			$data=array('product' => $product, 'complements' => $complements, 'qty' => $qty, 'subtotal' => number_format($subtotal, 2, ',', '.'), 'price' => $product->price, 'complement_price' => $complementPrice, 'code' => $code);
			session()->push('cart', $data);
		}
	}

	public function addCartDatabase($cart, $product, $code, $complements, $complementPrice, $qty=1) {
		$cart_product=CartProduct::where([['code', $code], ['cart_id', $cart->id]])->first();
		if (!is_null($cart_product)) {
			$qty=$cart_product->qty+$qty;
			$subtotal=($product->price+$complementPrice)*$qty;
			$data=array('price' => $product->price, 'complement_price' => $complementPrice, 'qty' => $qty, 'subtotal' => $subtotal);
			$cart_product->fill($data)->save();
		} else {
			$subtotal=($product->price+$complementPrice)*$qty;
			$data=array('code' => $code, 'price' => $product->price, 'complement_price' => $complementPrice, 'qty' => $qty, 'subtotal' => $subtotal, 'product_id' => $product->id, 'cart_id' => $cart->id);
			$cart_product=CartProduct::create($data);
			if ($cart_product) {
				foreach ($complements as $complement) {
					$qty=1;
					$subtotal=$complement->price*$qty;
					$data=array('price' => $complement->price, 'qty' => $qty, 'subtotal' => $subtotal, 'complement_id' => $complement->complement_id, 'group_id' => $complement->group_id, 'cart_product_id' => $cart_product->id);
					CartComplement::create($data);
				}
			}
		}
		return $cart_product;
	}

	public function plusCartSession($code) {
		$cart=session('cart');
		if (array_search($code, array_column($cart, 'code'))!==false) {
			$key=array_search($code, array_column($cart, 'code'));
			$cart[$key]['qty']=$cart[$key]['qty']+1;
			$subtotal=($cart[$key]['product']->price+$cart[$key]['complement_price'])*$cart[$key]['qty'];
			$cart[$key]['subtotal']=number_format($subtotal, 2, ',', '.');
			session()->put('cart', $cart);
		}
	}

	public function plusCartDatabase($code) {
		$cart=Cart::where('user_id', Auth::id())->first();
		$cart_product=CartProduct::where([['code', $code], ['cart_id', $cart->id]])->first();
		if (!is_null($cart_product)) {
			$qty=$cart_product->qty+1;
			$subtotal=($cart_product->price+$cart_product->complement_price)*$qty;
			$data=array('qty' => $qty, 'subtotal' => $subtotal);
			$cart_product->fill($data)->save();
			if ($cart_product) {
				$this->calculateCart();
				return true;
			}
		}
		return false;
	}

	public function minusCartSession($code) {
		$cart=session('cart');
		if (array_search($code, array_column($cart, 'code'))!==false) {
			$key=array_search($code, array_column($cart, 'code'));
			$cart[$key]['qty']=($cart[$key]['qty']>1) ? $cart[$key]['qty']-1 : 1;
			$subtotal=($cart[$key]['product']->price+$cart[$key]['complement_price'])*$cart[$key]['qty'];
			$cart[$key]['subtotal']=number_format($subtotal, 2, ',', '.');
			session()->put('cart', $cart);
		}
	}

	public function minusCartDatabase($code) {
		$cart=Cart::where('user_id', Auth::id())->first();
		$cart_product=CartProduct::where([['code', $code], ['cart_id', $cart->id]])->first();
		if (!is_null($cart_product)) {
			$qty=($cart_product->qty>1) ? $cart_product->qty-1 : 1;
			$subtotal=($cart_product->price+$cart_product->complement_price)*$qty;
			$data=array('qty' => $qty, 'subtotal' => $subtotal);
			$cart_product->fill($data)->save();
			if ($cart_product) {
				$this->calculateCart();
				return true;
			}
		}
		return false;
	}

	public function removeCartSession($code) {
		$cart=session('cart');
		if (array_search($code, array_column($cart, 'code'))!==false) {
			session()->forget('cart');
			foreach ($cart as $item) {
				if ($code!=$item['code']) {
					if (!session()->has('cart')) {
						session()->put('cart', array(0 => $item));
					} else {
						session()->push('cart', $item);
					}
				}
			}
		}
	}

	public function removeCartDatabase($code) {
		$cart=Cart::where('user_id', Auth::id())->first();
		$cart_product=CartProduct::where([['code', $code], ['cart_id', $cart->id]])->first();
		if (!is_null($cart_product)) {
			$cart_product->delete();
			if ($cart_product) {
				$this->calculateCart();
				return true;
			}
		}
		return false;
	}

	public function calculateCart() {
		$total=0.00;
		if (Auth::check()) {
			$cart=Cart::with(['products'])->where('user_id', Auth::id())->first();
			foreach($cart['products'] as $item) {
				$total+=($item->price+$item->complement_price)*$item->qty;
			}
			$cart->fill(['total' => $total])->save();
			return $total;
		}

		if (session()->has('cart')) {
			$cart=session('cart');
			foreach($cart as $item) {
				$total+=($item['price']+$item['complement_price'])*$item['qty'];
			}
		}
		return $total;
	}

	public function counterCart() {
		$counter=0;
		if (Auth::check()) {
			$cart=Cart::with(['products'])->where('user_id', Auth::id())->first();
			$counter=$cart['products']->count();
			return $counter;
		}

		if (session()->has('cart')) {
			$counter=count(session('cart'));
		}
		return $counter;
	}

	public function convertCartSessionToDatabase($user_id) {
		if (session()->has('cart')) {
			$cart=session('cart');
			$cart_database=Cart::where('user_id', $user_id)->first();
			foreach ($cart as $item) {
				$this->addCartDatabase($cart_database, $item['product'], $item['code'], $item['complements'], $item['complement_price'], $item['qty']);
			}
		}
	}
}