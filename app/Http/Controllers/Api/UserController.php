<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use JoeDixon\Translation\Language;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\User\UserStoreRequest;
use App\Http\Requests\Api\User\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendEmailRegister;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Arr;

class UserController extends ApiController
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if ($request->has('locale') && !is_null($request->locale)) {
                $language=Language::where('language', $request->locale)->first();
                if (!is_null($language)) {
                    app()->setLocale($language->language);
                }
            }
            return $next($request);
        });
    }

    /**
    *
    * @OA\Get(
    *   path="/api/v1/users",
    *   tags={"Users"},
    *   summary="Get users",
    *   description="Returns all users",
    *   operationId="indexUser",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="page",
    *       in="query",
    *       description="Number of page",
    *       required=false,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="locale",
    *       in="query",
    *       description="Locale for example ('es','en')",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Show all users.",
    *       @OA\MediaType(
    *           mediaType="application/json"
    *       )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Not authenticated."
    *   ),
    *   @OA\Response(
    *       response=403,
    *       description="Forbidden."
    *   )
    * )
    */
    public function index(Request $request) {
      $users=User::with(['roles', 'language'])->get()->map(function($user) {
         return $this->dataUser($user);
     });

      $page=Paginator::resolveCurrentPage('page');
      $pagination=new LengthAwarePaginator($users, $total=count($users), $perPage=15, $page, ['path' => Paginator::resolveCurrentPath(), 'pageName' => 'page']);
      $pagination=Arr::collapse([$pagination->toArray(), ['code' => 200, 'status' => 'success']]);

      return response()->json($pagination, 200);
  }

    /**
    *
    * @OA\Post(
    *   path="/api/v1/users",
    *   tags={"Users"},
    *   summary="Register user",
    *   description="Create a new user",
    *   operationId="storeUser",
    *   security={
    *       {"bearerAuth": {}}
    *   },
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
    *       name="phone",
    *       in="query",
    *       description="Phone of user",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="address",
    *       in="query",
    *       description="Address of user",
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
    *   @OA\Parameter(
    *       name="type",
    *       in="query",
    *       description="Type of user",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           enum={"Super Admin", "Administrador", "Cliente"}
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="locale",
    *       in="query",
    *       description="Locale for example ('es','en')",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Response(
    *       response=201,
    *       description="Registered user.",
    *       @OA\MediaType(
    *           mediaType="application/json"
    *       )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Not authenticated."
    *   ),
    *   @OA\Response(
    *       response=403,
    *       description="Forbidden."
    *   ),
    *   @OA\Response(
    *       response=422,
    *       description="Data not valid."
    *   ),
    *   @OA\Response(
    *       response=500,
    *       description="An error occurred during the process."
    *   )
    * )
    */
    public function store(UserStoreRequest $request) {
    	$data=array('name' => request('name'), 'lastname' => request('lastname'), 'phone' => request('phone'), 'address' => request('address'), 'email' => request('email'), 'password' => Hash::make(request('password')));
    	$user=User::create($data);

    	if ($user) {
    		$user->assignRole(request('type'));
    		SendEmailRegister::dispatch($user->slug);

            $user=User::with(['roles', 'language'])->where('id', $user->id)->first();
            $user=$this->dataUser($user);

            return response()->json(['code' => 201, 'status' => 'success', 'message' => trans('api.users.store'), 'data' => $user], 201);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Get(
    *   path="/api/v1/users/{id}",
    *   tags={"Users"},
    *   summary="Get user",
    *   description="Returns a single user",
    *   operationId="showUser",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="id",
    *       in="path",
    *       description="Search for ID",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="locale",
    *       in="query",
    *       description="Locale for example ('es','en')",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Show user.",
    *       @OA\MediaType(
    *           mediaType="application/json"
    *       )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Not authenticated."
    *   ),
    *   @OA\Response(
    *       response=403,
    *       description="Forbidden."
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="No results found."
    *   )
    * )
     */
    public function show(User $user) {
    	$user=$this->dataUser($user);
    	return response()->json(['code' => 200, 'status' => 'success', 'data' => $user], 200);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/users/{id}",
    *   tags={"Users"},
    *   summary="Update user",
    *   description="Update a single user",
    *   operationId="updateUser",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="id",
    *       in="path",
    *       description="Search for ID",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
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
    *       name="phone",
    *       in="query",
    *       description="Phone of user",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="address",
    *       in="query",
    *       description="Address of user",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="type",
    *       in="query",
    *       description="Type of user",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           enum={"Super Admin", "Administrador", "Cliente"}
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="locale",
    *       in="query",
    *       description="Locale for example ('es','en')",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Update user.",
    *       @OA\MediaType(
    *           mediaType="application/json"
    *       )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Not authenticated."
    *   ),
    *   @OA\Response(
    *       response=403,
    *       description="Forbidden."
    *   ),
    *   @OA\Response(
    *       response=422,
    *       description="Data not valid."
    *   ),
    *   @OA\Response(
    *       response=500,
    *       description="An error occurred during the process."
    *   )
    * )
    */
    public function update(UserUpdateRequest $request, User $user) {
    	$data=array('name' => request('name'), 'lastname' => request('lastname'), 'phone' => request('phone'), 'address' => request('address'));
    	$user->fill($data)->save();        

    	if ($user) {
    		if (!is_null(request('type'))) {
    			$user->syncRoles([request('type')]);
    		}
            $user=User::with(['roles', 'language'])->where('id', $user->id)->first();
            $user=$this->dataUser($user);

            return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.users.update'), 'data' => $user], 200);
        }
        
        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Delete(
    *   path="/api/v1/users/{id}",
    *   tags={"Users"},
    *   summary="Delete user",
    *   description="Delete a single user",
    *   operationId="destroyUser",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="id",
    *       in="path",
    *       description="Search for ID",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="locale",
    *       in="query",
    *       description="Locale for example ('es','en')",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Delete user.",
    *       @OA\MediaType(
    *           mediaType="application/json"
    *       )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Not authenticated."
    *   ),
    *   @OA\Response(
    *       response=403,
    *       description="Forbidden."
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="No results found."
    *   ),
    *   @OA\Response(
    *       response=500,
    *       description="An error occurred during the process."
    *   )
    * )
     */
    public function destroy(User $user)
    {
    	$user->delete();
    	if ($user) {
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.users.destroy')], 200);
    	}

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/users/{id}/deactivate",
    *   tags={"Users"},
    *   summary="Deactivate user",
    *   description="Deactivate a single user",
    *   operationId="deactivateUser",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="id",
    *       in="path",
    *       description="Search for ID",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="locale",
    *       in="query",
    *       description="Locale for example ('es','en')",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Deactivate user.",
    *       @OA\MediaType(
    *           mediaType="application/json"
    *       )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Not authenticated."
    *   ),
    *   @OA\Response(
    *       response=403,
    *       description="Forbidden."
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="No results found."
    *   ),
    *   @OA\Response(
    *       response=500,
    *       description="An error occurred during the process."
    *   )
    * )
     */
    public function deactivate(Request $request, User $user) {
    	$user->fill(['state' => "0"])->save();
    	if ($user) {
    		$user=$this->dataUser($user);
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.users.deactivate'), 'data' => $user], 200);
    	}

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/users/{id}/activate",
    *   tags={"Users"},
    *   summary="Activate user",
    *   description="Activate a single user",
    *   operationId="activateUser",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="id",
    *       in="path",
    *       description="Search for ID",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="locale",
    *       in="query",
    *       description="Locale for example ('es','en')",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Activate user.",
    *       @OA\MediaType(
    *           mediaType="application/json"
    *       )
    *   ),
    *   @OA\Response(
    *       response=401,
    *       description="Not authenticated."
    *   ),
    *   @OA\Response(
    *       response=403,
    *       description="Forbidden."
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="No results found."
    *   ),
    *   @OA\Response(
    *       response=500,
    *       description="An error occurred during the process."
    *   )
    * )
     */
    public function activate(Request $request, User $user) {
    	$user->fill(['state' => "1"])->save();
    	if ($user) {
    		$user=$this->dataUser($user);
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.users.activate'), 'data' => $user], 200);
    	}
        
    	return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }
}
