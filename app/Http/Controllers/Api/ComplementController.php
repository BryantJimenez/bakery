<?php

namespace App\Http\Controllers\Api;

use App\Models\Complement;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Complement\ComplementStoreRequest;
use App\Http\Requests\Api\Complement\ComplementUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Arr;

class ComplementController extends ApiController
{
    /**
    *
    * @OA\Get(
    *   path="/api/v1/complements",
    *   tags={"Complements"},
    *   summary="Get complements",
    *   description="Returns all complements",
    *   operationId="indexComplement",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Response(
    *       response=200,
    *       description="Show all complements.",
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
      $complements=Complement::get()->map(function($complement) {
         return $this->dataComplement($complement);
     });

      $page=Paginator::resolveCurrentPage('page');
      $pagination=new LengthAwarePaginator($complements, $total=count($complements), $perPage=15, $page, ['path' => Paginator::resolveCurrentPath(), 'pageName' => 'page']);
      $pagination=Arr::collapse([$pagination->toArray(), ['code' => 200, 'status' => 'success']]);

      return response()->json($pagination, 200);
  }

    /**
    *
    * @OA\Post(
    *   path="/api/v1/complements",
    *   tags={"Complements"},
    *   summary="Register complement",
    *   description="Create a new complement",
    *   operationId="storeComplement",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="name",
    *       in="query",
    *       description="Name of complement",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="description",
    *       in="query",
    *       description="Description of complement",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="price",
    *       in="query",
    *       description="Price of complement",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           format="float"
    *       )
    *   ),
    *   @OA\Response(
    *       response=201,
    *       description="Registered complement.",
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
    public function store(ComplementStoreRequest $request) {
        $data=array('name' => request('name'), 'description' => request('description'), 'price' => request('price'));
    	$complement=Complement::create($data);

    	if ($complement) {
            $complement=Complement::where('id', $complement->id)->first();
            $complement=$this->dataComplement($complement);

            return response()->json(['code' => 201, 'status' => 'success', 'message' => 'The complement has been successfully registered.', 'data' => $complement], 201);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'An error occurred during the process, please try again.'], 500);
    }

    /**
    *
    * @OA\Get(
    *   path="/api/v1/complements/{id}",
    *   tags={"Complements"},
    *   summary="Get complement",
    *   description="Returns a single complement",
    *   operationId="showComplement",
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
    *       description="Show complement.",
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
    public function show(Complement $complement) {
    	$complement=$this->dataComplement($complement);
    	return response()->json(['code' => 200, 'status' => 'success', 'data' => $complement], 200);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/complements/{id}",
    *   tags={"Complements"},
    *   summary="Update complement",
    *   description="Update a single complement",
    *   operationId="updateComplement",
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
    *       description="Name of complement",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="description",
    *       in="query",
    *       description="Description of complement",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="price",
    *       in="query",
    *       description="Price of complement",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           format="float"
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Update complement.",
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
    public function update(ComplementUpdateRequest $request, Complement $complement) {
        $data=array('name' => request('name'), 'description' => request('description'), 'price' => request('price'));
    	$complement->fill($data)->save();

    	if ($complement) {
            $complement=Complement::where('id', $complement->id)->first();
            $complement=$this->dataComplement($complement);

            return response()->json(['code' => 200, 'status' => 'success', 'message' => 'The complement has been edited successfully.', 'data' => $complement], 200);
        }
        
        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'An error occurred during the process, please try again.'], 500);
    }

    /**
    *
    * @OA\Delete(
    *   path="/api/v1/complements/{id}",
    *   tags={"Complements"},
    *   summary="Delete complement",
    *   description="Delete a single complement",
    *   operationId="destroyComplement",
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
    *       description="Delete complement.",
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
    public function destroy(Complement $complement)
    {
    	$complement->delete();
    	if ($complement) {
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => 'The complement has been successfully removed.'], 200);
    	}

        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'An error occurred during the process, please try again.'], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/complements/{id}/deactivate",
    *   tags={"Complements"},
    *   summary="Deactivate complement",
    *   description="Deactivate a single complement",
    *   operationId="deactivateComplement",
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
    *       description="Deactivate complement.",
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
    public function deactivate(Request $request, Complement $complement) {
    	$complement->fill(['state' => "0"])->save();
    	if ($complement) {
    		$complement=$this->dataComplement($complement);
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => 'The complement has been successfully deactivated.', 'data' => $complement], 200);
    	}

        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'An error occurred during the process, please try again.'], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/complements/{id}/activate",
    *   tags={"Complements"},
    *   summary="Activate complement",
    *   description="Activate a single complement",
    *   operationId="activateComplement",
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
    *       description="Activate complement.",
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
    public function activate(Request $request, Complement $complement) {
    	$complement->fill(['state' => "1"])->save();
    	if ($complement) {
    		$complement=$this->dataComplement($complement);
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => 'The complement has been successfully activated.', 'data' => $complement], 200);
    	}
        
    	return response()->json(['code' => 500, 'status' => 'error', 'message' => 'An error occurred during the process, please try again.'], 500);
    }
}
