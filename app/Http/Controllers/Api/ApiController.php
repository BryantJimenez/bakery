<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
* @OA\Info(
*	title="API Bakery",
*	version="1.0",
*   @OA\License(
*   	name="Apache 2.0",
*       url="http://www.apache.org/licenses/LICENSE-2.0.html"
*   )
* )
*
* @OA\Server(url="http://localhost:8000")
* @OA\Server(url="http://bakery.otterscompany.com")
*
* @OA\Tag(
*	name="Login",
*	description="Login users endpoints"
* )
*
* @OA\Tag(
*	name="Register",
*	description="Register users endpoint"
* )
*
* @OA\Tag(
*	name="Logout",
*	description="Logout users endpoint"
* )
*
* @OA\Tag(
*	name="Profile",
*	description="User profile endpoints"
* )
*
* @OA\Tag(
*	name="Cart",
*	description="User cart endpoints"
* )
*
* @OA\Tag(
*	name="Profile Orders",
*	description="User orders endpoints"
* )
*
* @OA\Tag(
*	name="Users",
*	description="Users endpoints"
* )
*
* @OA\Tag(
*	name="Customers",
*	description="Customers endpoints"
* )
*
* @OA\Tag(
*	name="Categories",
*	description="Categories endpoints"
* )
*
* @OA\Tag(
*	name="Products",
*	description="Products endpoints"
* )
*
* @OA\Tag(
*	name="Complements",
*	description="Complements endpoints"
* )
*
* @OA\Tag(
*	name="Groups",
*	description="Groups endpoints"
* )
*
* @OA\Tag(
*	name="Orders",
*	description="Orders endpoints"
* )
*
* @OA\Tag(
*	name="Agencies",
*	description="Agencies endpoints"
* )
*
* @OA\Tag(
*	name="Attributes",
*	description="Attributes endpoints"
* )
*
* @OA\Tag(
*	name="Coupons",
*	description="Coupons endpoints"
* )
*
* @OA\Tag(
*	name="Currencies",
*	description="Currencies endpoints"
* )
*
* @OA\Tag(
*	name="Languages",
*	description="Languages endpoints"
* )
*
* @OA\Tag(
*	name="Schedules",
*	description="Schedules endpoints"
* )
*
* @OA\Tag(
*	name="Settings",
*	description="Settings endpoints"
* )
*
* @OA\SecurityScheme(
*	securityScheme="bearerAuth",
*   in="header",
*   name="bearerAuth",
*   type="http",
*   scheme="bearer",
*   bearerFormat="JWT"
* )
*/
class ApiController extends Controller
{
	public function dataUser($user) {
		$user->phone=(!is_null($user->phone)) ? $user->phone : '';
		$user->address=(!is_null($user->address)) ? $user->address : '';
		$user->rol=roleUser($user, false);
		$user->photo=(!is_null($user->photo)) ? asset('/admins/img/users/'.$user->photo) : '';
		$user->language=(!is_null($user['language']) && !empty($user['language'])) ? $this->dataLanguage($user['language']) : [];
		$data=$user->only("id", "name", "lastname", "slug", "photo", "phone", "address", "email", "points", "state", "language", "rol");
		return $data;
	}

	public function dataCart($cart) {
		$cart->products=$cart['products']->map(function($cart_product) {
			return $this->dataCartProduct($cart_product);
		});
		$data=$cart->only("id", "total", "products");
		return $data;
	}

	public function dataCartProduct($cart_product) {
		if (!is_null($cart_product['product'])) {
			$cart_product['product']->image=(!is_null($cart_product['product']->image)) ? asset('/admins/img/products/'.$cart_product['product']->image) : '';
			$cart_product['product']->category=(!is_null($cart_product['product']['category'])) ? $this->dataCategory($cart_product['product']['category']) : [];
			$product=$cart_product['product']->only("id", "name", "slug", "image", "price", "state", "category");
		} else {
			$product=[];
		}
		$cart_product->product=$product;
		$cart_product->complements=$cart_product['complements']->map(function($cart_product_complement) {
			return $this->dataCartProductComplement($cart_product_complement);
		});
		$data=$cart_product->only("id", "qty", "price", "complement_price", "subtotal", "product", "complements");
		return $data;
	}

	public function dataCartProductComplement($cart_product_complement) {
		$cart_product_complement->attribute="";
		$cart_product_complement->complement=(!is_null($cart_product_complement['complement'])) ? $cart_product_complement['complement']->name : "";
		if (!is_null($cart_product_complement['group'])) {
			$cart_product_complement->attribute=(!is_null($cart_product_complement['group']['attribute'])) ? $cart_product_complement['group']['attribute']->name : "";
		}
		$data=$cart_product_complement->only("id", "qty", "price", "subtotal", "complement", "attribute");
		return $data;
	}

	public function dataCategory($category) {
		$data=$category->only("id", "name", "slug", "image", "state");
		$data['image']=(!is_null($category->image)) ? asset('/admins/img/categories/'.$category->image) : '';
		return $data;
	}

	public function dataProduct($product) {
		$product->image=(!is_null($product->image)) ? asset('/admins/img/products/'.$product->image) : '';
		$product->description=(!is_null($product->description)) ? $product->description : '';
		$product->category=(!is_null($product['category'])) ? $this->dataCategory($product['category']) : [];
		$product->groups=$product['groups']->map(function($group) {
			return $this->dataGroup($group);
		});
		$data=$product->only("id", "name", "slug", "image", "description", "price", "state", "category", "groups");
		return $data;
	}

	public function dataComplement($complement, $pivot=false) {
		$data=$complement->only("id", "name", "slug", "image", "description", "price", "state");
		$data['image']=(!is_null($complement->image)) ? asset('/admins/img/complements/'.$complement->image) : '';
		$data['description']=(!is_null($complement->description)) ? $complement->description : '';
		if ($pivot) {
			$data['price']=$complement['pivot']->price;
			$data['state']=stateComplement($complement['pivot']->state, false);
		}
		return $data;
	}

	public function dataGroup($group) {
		$group->attribute=(!is_null($group['attribute'])) ? $this->dataAttribute($group['attribute']) : [];
		$group->complements=$group['complements']->map(function($complement) {
			return $this->dataComplement($complement, true);
		});
		$data=$group->only("id", "name", "slug", "condition", "min", "max", "state", "attribute", "complements");
		return $data;
	}

	public function dataOrder($order) {
		$order->user=(!is_null($order['user'])) ? $this->dataUser($order['user']) : [];
		$order->currency=(!is_null($order['currency'])) ? $this->dataCurrency($order['currency']) : [];
		$order->shipping=(!is_null($order['shipping'])) ? $this->dataShipping($order['shipping']) : [];
		$order->payment=(!is_null($order['payment'])) ? $this->dataPayment($order['payment']) : [];
		if (!is_null($order['coupon'])) {
			$order->coupon=$order['coupon']->only("id", "code", "slug", "discount", "type", "state");
		} else {
			$order->coupon=[];
		}
		$order->products=$order['order_products']->map(function($order_product) {
			if (!is_null($order_product['product'])) {
				$order_product['product']->image=(!is_null($order_product['product']->image)) ? asset('/admins/img/products/'.$order_product['product']->image) : '';
				$order_product['product']->category=(!is_null($order_product['product']['category'])) ? $this->dataCategory($order_product['product']['category']) : [];
				$product=$order_product['product']->only("id", "name", "slug", "image", "price", "state", "category");
			} else {
				$product=[];
			}
			$order_product->product=$product;
			$order_product->complements=$order_product['complements']->map(function($product_complement) {
				return $this->dataCartProductComplement($product_complement);
			});
			
			$data=$order_product->only("id", "qty", "price", "complement_price", "subtotal", "product", "complements");
			return $data;
		});
		$data=$order->only("id", "subtotal", "delivery", "discount", "total", "fee", "balance", "state", "user", "currency", "shipping", "payment", "coupon", "products");
		return $data;
	}

	public function dataAgency($agency) {
		$agency->description=(!is_null($agency->description)) ? $agency->description : '';
		$data=$agency->only("id", "name", "slug", "route", "description", "price", "state");
		return $data;
	}

	public function dataAttribute($attribute) {
		$data=$attribute->only("id", "name", "slug", "state");
		return $data;
	}

	public function dataCoupon($coupon) {
		$data=$coupon->only("id", "code", "slug", "discount", "limit", "use", "type", "state");
		return $data;
	}

	public function dataCurrency($currency) {
		$data=$currency->only("id", "name", "slug", "iso", "symbol", "state");
		return $data;
	}

	public function dataShipping($shipping) {
		$shipping->price=$shipping->order->delivery;
		$shipping->agency=(!is_null($shipping['agency'])) ? $this->dataAgency($shipping['agency']) : [];
		$data=$shipping->only("id", "price", "address", "agency");
		return $data;
	}

	public function dataPayment($payment) {
		$data=$payment->only("id", "subtotal", "delivery", "discount", "total", "fee", "balance", "method", "state");
		return $data;
	}

	public function dataLanguage($language) {
		$language->locale=$language->language;
		$data=$language->only("id", "name", "locale");
		return $data;
	}

	public function dataSchedule($schedule) {
		$schedule->start_time=date('H:i', strtotime($schedule->start));
		$schedule->end_time=date('H:i', strtotime($schedule->end));
		$schedule->days=collect($schedule->days)->map(function($day) {
			return trans('admin.values_attributes.days.'.$day);
		});
		$data=$schedule->only("id", "start_time", "end_time", "days", "state");
		return $data;
	}

	public function dataSetting($setting) {
		$setting->terms=(!is_null($setting->terms)) ? $setting->terms : "";
		$setting->privacity=(!is_null($setting->privacity)) ? $setting->privacity : "";
		$setting->stripe_public=(!is_null($setting->stripe_public)) ? $setting->stripe_public : "";
		$setting->stripe_secret=(!is_null($setting->stripe_secret)) ? $setting->stripe_secret : "";
		$setting->currency=(!is_null($setting['currency'])) ? $this->dataCurrency($setting['currency']) : [];
		$data=$setting->only("id", "terms", "privacity", "stripe_public", "stripe_secret", "currency", 'force', 'state');
		return $data;
	}
}