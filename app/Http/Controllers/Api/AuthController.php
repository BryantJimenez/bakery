<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Cart\Cart;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;

class AuthController extends ApiController
{
	/**
	* @OA\Post(
	*	path="/api/v1/auth/login",
	*   tags={"Login"},
	*   summary="Login",
	*   description="Login for users",
	*   operationId="login",
	*   @OA\Parameter(
	*      	name="email",
	*      	in="query",
	*      	required=true,
	*      	@OA\Schema(
	*      		type="string"
	*      	)
	*   ),
	*   @OA\Parameter(
	*      	name="password",
	*      	in="query",
	*      	required=true,
	*      	@OA\Schema(
	*        	type="string"
	*      	)
	*   ),
	*   @OA\Response(
	*      	response=200,
	*      	description="Login success",
	*      	@OA\MediaType(
	*           mediaType="application/json",
	*      	)
	*   ),
	* 	@OA\Response(
    *   	response=401,
    *   	description="Not authenticated."
    * 	),
    *   @OA\Response(
    *       response=403,
    *       description="Forbidden."
    *   ),
    * 	@OA\Response(
    *  		response=422,
    *   	description="Data not valid."
    * 	)
	* )
     **/
	public function login(LoginRequest $request) {
		$user=User::where('email', request('email'))->first();

		if (!Hash::check(request('password'), $user->password)) {
            return response()->json(['code' => 422, 'status' => 'error', 'message' => trans('api.errors.422.auth')], 422);
        }

        if ($user->state=='Inativo') {
            return response()->json(['code' => 403, 'status' => 'error', 'message' => trans('api.errors.403.auth')], 403);
        }

        Auth::login($user);

        if(Auth::check()) {
            $user=$request->user();
            $tokenResult=$user->createToken('Personal Access Token');

            $token=$tokenResult->token;
            if (!is_null(request('remember'))) {
                $token->expires_at=Carbon::now()->addYears(10);
            }
            $token->save();

            return response()->json(['code' => 200, 'status' => 'success', 'access_token' => $tokenResult->accessToken, 'token_type' => 'Bearer', 'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()]);
        }

        return response()->json(['code' => 401, 'status' => 'error', 'message' => trans('api.errors.401.auth')], 401);
    }

	/**
    * @OA\Post(
    *	path="/api/v1/auth/register",
    *   tags={"Register"},
    *   summary="Register user",
    *   operationId="register",
    *   @OA\Parameter(
    *       name="name",
    *       in="query",
    *       description="Name of user",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="lastname",
    *       in="query",
    *       description="Lastname of user",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="email",
    *       in="query",
    *       description="Email of user",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="password",
    *       in="query",
    *       description="Password of user",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="password_confirmation",
    *       in="query",
    *       description="Password confirm of user",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    * 	@OA\Response(
    * 		response=201,
    *   	description="Register user.",
    *   	@OA\MediaType(
    *      		mediaType="application/json",
    *   	)
    * 	),
    * 	@OA\Response(
    *   	response=401,
    *   	description="Not authenticated."
    * 	),
    * 	@OA\Response(
    *  		response=422,
    *   	description="Data not valid."
    * 	),
    * 	@OA\Response(
    *   	response=500,
    *   	description="An error occurred during the process."
    * 	)
    * )
     **/
	public function register(RegisterRequest $request) {
        $data=array('name' => request('name'), 'lastname' => request('lastname'), 'email' => request('email'), 'password' => Hash::make(request('password')));
        $user=User::create($data);

        if ($user) {
            $user->assignRole('Cliente');
            Cart::create(['user_id' => $user->id]);
            $user=User::with(['roles'])->where('id', $user->id)->first();
            $user=$this->dataUser($user);
            
            return response()->json(['code' => 201, 'status' => 'success', 'message' => trans('api.auth.register'), 'data' => $user], 201);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Get(
    *   path="/api/v1/auth/logout",
    *   tags={"Logout"},
    *   summary="Logout",
    *   description="Account log out",
    *   operationId="logout",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Response(
    *       response=200,
    *       description="Logout success.",
    *       @OA\MediaType(
    *           mediaType="application/json"
    *       )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Not authenticated."
    *   )
    * )
    */
    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.auth.logout')], 200);
    }
}
