<?php

namespace App\Http\Controllers\Api;

use App\Models\Complement;
use JoeDixon\Translation\Language;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Complement\ComplementStoreRequest;
use App\Http\Requests\Api\Complement\ComplementUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Arr;

class ComplementController extends ApiController
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
    *   path="/api/v1/complements",
    *   tags={"Complements"},
    *   summary="Get complements",
    *   description="Returns all complements",
    *   operationId="indexComplement",
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
    public function index(Request $request) {
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
    *       name="name[es]",
    *       in="query",
    *       description="Name of complement in spanish (The key of the value must be the locale of the language)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="name[en]",
    *       in="query",
    *       description="Name of complement in english (The key of the value must be the locale of the language)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="description[es]",
    *       in="query",
    *       description="Description of complement in spanish (The key of the value must be the locale of the language)",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="description[en]",
    *       in="query",
    *       description="Description of complement in english (The key of the value must be the locale of the language)",
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

            return response()->json(['code' => 201, 'status' => 'success', 'message' => trans('api.complements.store'), 'data' => $complement], 201);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
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
    *       name="name[es]",
    *       in="query",
    *       description="Name of complement in spanish (The key of the value must be the locale of the language)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="name[en]",
    *       in="query",
    *       description="Name of complement in english (The key of the value must be the locale of the language)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="description[es]",
    *       in="query",
    *       description="Description of complement in spanish (The key of the value must be the locale of the language)",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="description[en]",
    *       in="query",
    *       description="Description of complement in english (The key of the value must be the locale of the language)",
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

            return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.complements.update'), 'data' => $complement], 200);
        }
        
        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
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
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.complements.destroy')], 200);
    	}

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
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
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.complements.deactivate'), 'data' => $complement], 200);
    	}

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
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
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.complements.activate'), 'data' => $complement], 200);
    	}
        
    	return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }
}
