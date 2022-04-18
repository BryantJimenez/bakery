<?php

namespace App\Http\Controllers\Api;

use App\Models\Attribute;
use JoeDixon\Translation\Language;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Attribute\AttributeStoreRequest;
use App\Http\Requests\Api\Attribute\AttributeUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Arr;
use Str;

class AttributeController extends ApiController
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
    *   path="/api/v1/attributes",
    *   tags={"Attributes"},
    *   summary="Get attributes",
    *   description="Returns all attributes",
    *   operationId="indexAttribute",
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
    *       description="Show all attributes.",
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
        $attributes=Attribute::get()->map(function($attribute) {
            return $this->dataAttribute($attribute);
        });

        $page=Paginator::resolveCurrentPage('page');
        $pagination=new LengthAwarePaginator($attributes, $total=count($attributes), $perPage=15, $page, ['path' => Paginator::resolveCurrentPath(), 'pageName' => 'page']);
        $pagination=Arr::collapse([$pagination->toArray(), ['code' => 200, 'status' => 'success']]);

        return response()->json($pagination, 200);
    }

    /**
    *
    * @OA\Post(
    *   path="/api/v1/attributes",
    *   tags={"Attributes"},
    *   summary="Register attribute",
    *   description="Create a new attribute",
    *   operationId="storeAttribute",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="name[es]",
    *       in="query",
    *       description="Name of attribute in spanish (The key of the value must be the locale of the language)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="name[en]",
    *       in="query",
    *       description="Name of attribute in english (The key of the value must be the locale of the language)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
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
    *       description="Registered attribute.",
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
    public function store(AttributeStoreRequest $request) {
        $trashed=Attribute::where('slug', Str::slug(request('name')['es']))->withTrashed()->exists();
        $exist=Attribute::where('slug', Str::slug(request('name')['es']))->exists();
        if ($trashed && $exist===false) {
            $attribute=Attribute::where('slug', Str::slug(request('name')['es']))->withTrashed()->first();
            $attribute->restore();
        } else if ($exist) {
            return response()->json(['code' => 422, 'status' => 'error', 'message' => trans('api.errors.422.attribute')], 422);
        } else {
            $attribute=Attribute::create(['name' => request('name')]);
        }
        
        if ($attribute) {
            $attribute=Attribute::where('id', $attribute->id)->first();
            $attribute=$this->dataAttribute($attribute);
            return response()->json(['code' => 201, 'status' => 'success', 'message' => trans('api.attributes.store'), 'data' => $attribute], 201);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Get(
    *   path="/api/v1/attributes/{id}",
    *   tags={"Attributes"},
    *   summary="Get attribute",
    *   description="Returns a single attribute",
    *   operationId="showAttribute",
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
    *       description="Show attribute.",
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
    public function show(Attribute $attribute) {
        $attribute=$this->dataAttribute($attribute);
        return response()->json(['code' => 200, 'status' => 'success', 'data' => $attribute], 200);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/attributes/{id}",
    *   tags={"Attributes"},
    *   summary="Update attribute",
    *   description="Update a single attribute",
    *   operationId="updateAttribute",
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
    *       description="Name of attribute in spanish (The key of the value must be the locale of the language)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="name[en]",
    *       in="query",
    *       description="Name of attribute in english (The key of the value must be the locale of the language)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
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
    *       description="Update attribute.",
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
    public function update(AttributeUpdateRequest $request, Attribute $attribute) {
        $attribute->fill(['name' => request('name')])->save();        
        if ($attribute) {
            $attribute=Attribute::where('id', $attribute->id)->first();
            $attribute=$this->dataAttribute($attribute);
            return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.attributes.update'), 'data' => $attribute], 200);
        }
        
        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Delete(
    *   path="/api/v1/attributes/{id}",
    *   tags={"Attributes"},
    *   summary="Delete attribute",
    *   description="Delete a single attribute",
    *   operationId="destroyAttribute",
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
    *       description="Delete attribute.",
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
    public function destroy(Attribute $attribute)
    {
    	$attribute->delete();
    	if ($attribute) {
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.attributes.destroy')], 200);
    	}

    	return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/attributes/{id}/deactivate",
    *   tags={"Attributes"},
    *   summary="Deactivate attribute",
    *   description="Deactivate a single attribute",
    *   operationId="deactivateAttribute",
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
    *       description="Deactivate attribute.",
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
    public function deactivate(Request $request, Attribute $attribute) {
    	$attribute->fill(['state' => "0"])->save();
    	if ($attribute) {
            $attribute=$this->dataAttribute($attribute);
            return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.attributes.deactivate'), 'data' => $attribute], 200);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/attributes/{id}/activate",
    *   tags={"Attributes"},
    *   summary="Activate attribute",
    *   description="Activate a single attribute",
    *   operationId="activateAttribute",
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
    *       description="Activate attribute.",
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
    public function activate(Request $request, Attribute $attribute) {
    	$attribute->fill(['state' => "1"])->save();
    	if ($attribute) {
    		$attribute=$this->dataAttribute($attribute);
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.attributes.activate'), 'data' => $attribute], 200);
    	}

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }
}
