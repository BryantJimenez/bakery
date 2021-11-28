<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Customer\CustomerStoreRequest;
use App\Http\Requests\Api\Customer\CustomerUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendEmailRegister;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Arr;

class CustomerController extends ApiController
{
    /**
    *
    * @OA\Get(
    *   path="/api/v1/customers",
    *   tags={"Customers"},
    *   summary="Get customers",
    *   description="Returns all customers",
    *   operationId="indexCustomer",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Response(
    *       response=200,
    *       description="Show all customers.",
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
    public function index() {
        $users=User::with(['roles'])->role(['Customer'])->get()->map(function($user) {
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
    *   path="/api/v1/customers",
    *   tags={"Customers"},
    *   summary="Register customer",
    *   description="Create a new customer",
    *   operationId="storeCustomer",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="name",
    *       in="query",
    *       description="Name of customer",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="lastname",
    *       in="query",
    *       description="Lastname of customer",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="email",
    *       in="query",
    *       description="Email of customer",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="password",
    *       in="query",
    *       description="Password of customer",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="password_confirmation",
    *       in="query",
    *       description="Password confirm of customer",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Response(
    *       response=201,
    *       description="Registered customer.",
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
    public function store(CustomerStoreRequest $request) {
    	$data=array('name' => request('name'), 'lastname' => request('lastname'), 'email' => request('email'), 'password' => Hash::make(request('password')));
    	$customer=User::create($data);

    	if ($customer) {
    		$customer->assignRole('Customer');
    		SendEmailRegister::dispatch($customer->slug);

            $customer=User::with(['roles'])->where('id', $customer->id)->first();
            $customer=$this->dataUser($customer);

            return response()->json(['code' => 201, 'status' => 'success', 'message' => 'The customer has been successfully registered.', 'data' => $customer], 201);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'An error occurred during the process, please try again.'], 500);
    }

    /**
    *
    * @OA\Get(
    *   path="/api/v1/customers/{id}",
    *   tags={"Customers"},
    *   summary="Get customer",
    *   description="Returns a single customer",
    *   operationId="showCustomer",
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
    *   @OA\Response(
    *       response=200,
    *       description="Show customer.",
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
    public function show(User $customer) {
        if (is_null($customer['roles']->where('name', 'Customer')->first())) {
            return response()->json(['code' => 200, 'status' => 'warning', 'message' => 'This user is not a customer'], 200);
        }
        $customer=$this->dataUser($customer);
        return response()->json(['code' => 200, 'status' => 'success', 'data' => $customer], 200);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/customers/{id}",
    *   tags={"Customers"},
    *   summary="Update customer",
    *   description="Update a single customer",
    *   operationId="updateCustomer",
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
    *       description="Name of customer",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="lastname",
    *       in="query",
    *       description="Lastname of customer",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Registered customer.",
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
    public function update(CustomerUpdateRequest $request, User $customer) {
        if (is_null($customer['roles']->where('name', 'Customer')->first())) {
            return response()->json(['code' => 200, 'status' => 'warning', 'message' => 'This user is not a customer'], 200);
        }

        $data=array('name' => request('name'), 'lastname' => request('lastname'));
        $customer->fill($data)->save();

        if ($customer) {
          $customer->syncRoles(['Customer']);
          $customer=User::with(['roles'])->where('id', $customer->id)->first();
          $customer=$this->dataUser($customer);

          return response()->json(['code' => 200, 'status' => 'success', 'message' => 'The customer has been edited successfully.', 'data' => $customer], 200);
      }

      return response()->json(['code' => 500, 'status' => 'error', 'message' => 'An error occurred during the process, please try again.'], 500);
  }

    /**
    *
    * @OA\Delete(
    *   path="/api/v1/customers/{id}",
    *   tags={"Customers"},
    *   summary="Delete customer",
    *   description="Delete a single customer",
    *   operationId="destroyCustomer",
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
    *   @OA\Response(
    *       response=200,
    *       description="Delete customer.",
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
    public function destroy(User $customer)
    {
        if (is_null($customer['roles']->where('name', 'Customer')->first())) {
            return response()->json(['code' => 200, 'status' => 'warning', 'message' => 'This user is not a customer'], 200);
        }

        $customer->delete();
        if ($customer) {
          return response()->json(['code' => 200, 'status' => 'success', 'message' => 'The user has been successfully removed.'], 200);
      }

      return response()->json(['code' => 500, 'status' => 'error', 'message' => 'An error occurred during the process, please try again.'], 500);
  }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/customers/{id}/deactivate",
    *   tags={"Customers"},
    *   summary="Deactivate customer",
    *   description="Deactivate a single customer",
    *   operationId="deactivateCustomer",
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
    *   @OA\Response(
    *       response=200,
    *       description="Deactivate customer.",
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
    public function deactivate(Request $request, User $customer) {
        if (is_null($customer['roles']->where('name', 'Customer')->first())) {
            return response()->json(['code' => 200, 'status' => 'warning', 'message' => 'This user is not a customer'], 200);
        }

        $customer->fill(['state' => "0"])->save();
        if ($customer) {
          $customer=$this->dataUser($customer);
          return response()->json(['code' => 200, 'status' => 'success', 'message' => 'The customer has been successfully deactivated.', 'data' => $customer], 200);
      }

      return response()->json(['code' => 500, 'status' => 'error', 'message' => 'An error occurred during the process, please try again.'], 500);
  }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/customers/{id}/activate",
    *   tags={"Customers"},
    *   summary="Activate customer",
    *   description="Activate a single customer",
    *   operationId="activateCustomer",
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
    *   @OA\Response(
    *       response=200,
    *       description="Activate customer.",
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
    public function activate(Request $request, User $customer) {
        if (is_null($customer['roles']->where('name', 'Customer')->first())) {
            return response()->json(['code' => 200, 'status' => 'warning', 'message' => 'This user is not a customer'], 200);
        }

        $customer->fill(['state' => "1"])->save();
        if ($customer) {
          $customer=$this->dataUser($customer);
          return response()->json(['code' => 200, 'status' => 'success', 'message' => 'The customer has been successfully activated.', 'data' => $customer], 200);
      }

      return response()->json(['code' => 500, 'status' => 'error', 'message' => 'An error occurred during the process, please try again.'], 500);
  }
}
