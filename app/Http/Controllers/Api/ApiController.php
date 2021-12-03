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
*	name="Agencies",
*	description="Agencies endpoints"
* )
*
* @OA\Tag(
*	name="Attributes",
*	description="Attributes endpoints"
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
		$user->rol=roleUser($user, false);
		$user->photo=(!is_null($user->photo)) ? asset('/admins/img/users/'.$user->photo) : '';
		$data=$user->only("id", "name", "lastname", "slug", "photo", "phone", "email", "state", "rol");
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

	public function dataAgency($agency) {
		$agency->description=(!is_null($agency->description)) ? $agency->description : '';
		$data=$agency->only("id", "name", "slug", "route", "description", "price", "state");
		return $data;
	}

	public function dataAttribute($attribute) {
		$data=$attribute->only("id", "name", "slug", "state");
		return $data;
	}
}