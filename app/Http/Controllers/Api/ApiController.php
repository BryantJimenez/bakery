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
*	name="Categories",
*	description="Categories endpoints"
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
		$user->rol=roleUser($user, false);
		$user->photo=(!is_null($user->photo)) ? asset('/admins/img/users/'.$user->photo) : '';
		$data=$user->only("id", "name", "lastname", "slug", "photo", "email", "state", "rol");
		return $data;
	}

	public function dataCategory($category) {
		$category->image=(!is_null($category->image)) ? asset('/admins/img/categories/'.$category->image) : '';
		$data=$category->only("id", "name", "slug", "image", "state");
		return $data;
	}
}