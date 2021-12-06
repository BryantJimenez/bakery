<?php

namespace App\Http\Controllers\Api;

use App\Models\Agency;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Agency\AgencyStoreRequest;
use App\Http\Requests\Api\Agency\AgencyUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Arr;

class AgencyController extends ApiController
{
    /**
    *
    * @OA\Get(
    *   path="/api/v1/agencies",
    *   tags={"Agencies"},
    *   summary="Get agencies",
    *   description="Returns all agencies",
    *   operationId="indexAgency",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Response(
    *       response=200,
    *       description="Show all agencies.",
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
        $agencies=Agency::get()->map(function($agency) {
            return $this->dataAgency($agency);
        });

        $page=Paginator::resolveCurrentPage('page');
        $pagination=new LengthAwarePaginator($agencies, $total=count($agencies), $perPage=15, $page, ['path' => Paginator::resolveCurrentPath(), 'pageName' => 'page']);
        $pagination=Arr::collapse([$pagination->toArray(), ['code' => 200, 'status' => 'success']]);

        return response()->json($pagination, 200);
    }

    /**
    *
    * @OA\Post(
    *   path="/api/v1/agencies",
    *   tags={"Agencies"},
    *   summary="Register agency",
    *   description="Create a new agency",
    *   operationId="storeAgency",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="name",
    *       in="query",
    *       description="Name of agency",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="route",
    *       in="query",
    *       description="Route of agency",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="price",
    *       in="query",
    *       description="Price of agency",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           format="float"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="description",
    *       in="query",
    *       description="Description of agency",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Response(
    *       response=201,
    *       description="Registered agency.",
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
    public function store(AgencyStoreRequest $request) {
        $data=array('name' => request('name'), 'route' => request('route'), 'description' => request('description'), 'price' => request('price'));
        $agency=Agency::create($data);
        if ($agency) {
            $agency=Agency::where('id', $agency->id)->first();
            $agency=$this->dataAgency($agency);
            return response()->json(['code' => 201, 'status' => 'success', 'message' => 'La agencia ha sido registrada exitosamente.', 'data' => $agency], 201);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'], 500);
    }

    /**
    *
    * @OA\Get(
    *   path="/api/v1/agencies/{id}",
    *   tags={"Agencies"},
    *   summary="Get agency",
    *   description="Returns a single agency",
    *   operationId="showAgency",
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
    *       description="Show agency.",
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
    public function show(Agency $agency) {
        $agency=$this->dataAgency($agency);
        return response()->json(['code' => 200, 'status' => 'success', 'data' => $agency], 200);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/agencies/{id}",
    *   tags={"Agencies"},
    *   summary="Update agency",
    *   description="Update a single agency",
    *   operationId="updateAgency",
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
    *       description="Name of agency",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="route",
    *       in="query",
    *       description="Route of agency",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="price",
    *       in="query",
    *       description="Price of agency",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           format="float"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="description",
    *       in="query",
    *       description="Description of agency",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Update agency.",
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
    public function update(AgencyUpdateRequest $request, Agency $agency) {
        $data=array('name' => request('name'), 'route' => request('route'), 'description' => request('description'), 'price' => request('price'));
        $agency->fill($data)->save();
        if ($agency) {
            $agency=Agency::where('id', $agency->id)->first();
            $agency=$this->dataAgency($agency);
            return response()->json(['code' => 200, 'status' => 'success', 'message' => 'La agencia ha sido editada exitosamente.', 'data' => $agency], 200);
        }
        
        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'], 500);
    }

    /**
    *
    * @OA\Delete(
    *   path="/api/v1/agencies/{id}",
    *   tags={"Agencies"},
    *   summary="Delete agency",
    *   description="Delete a single agency",
    *   operationId="destroyAgency",
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
    *       description="Delete agency.",
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
    public function destroy(Agency $agency)
    {
    	$agency->delete();
    	if ($agency) {
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => 'La agencia ha sido eliminada exitosamente.'], 200);
    	}

    	return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/agencies/{id}/deactivate",
    *   tags={"Agencies"},
    *   summary="Deactivate agency",
    *   description="Deactivate a single agency",
    *   operationId="deactivateAgency",
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
    *       description="Deactivate agency.",
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
    public function deactivate(Request $request, Agency $agency) {
    	$agency->fill(['state' => "0"])->save();
    	if ($agency) {
            $agency=$this->dataAgency($agency);
            return response()->json(['code' => 200, 'status' => 'success', 'message' => 'La agencia ha sido desactivada exitosamente.', 'data' => $agency], 200);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/agencies/{id}/activate",
    *   tags={"Agencies"},
    *   summary="Activate agency",
    *   description="Activate a single agency",
    *   operationId="activateAgency",
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
    *       description="Activate agency.",
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
    public function activate(Request $request, Agency $agency) {
    	$agency->fill(['state' => "1"])->save();
    	if ($agency) {
    		$agency=$this->dataAgency($agency);
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => 'La agencia ha sido activada exitosamente.', 'data' => $agency], 200);
    	}

        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'], 500);
    }
}
