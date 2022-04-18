<?php

namespace App\Http\Controllers\Api;

use App\Models\Currency;
use JoeDixon\Translation\Language;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Currency\CurrencyStoreRequest;
use App\Http\Requests\Api\Currency\CurrencyUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Arr;
use Str;

class CurrencyController extends ApiController
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
    *   path="/api/v1/currencies",
    *   tags={"Currencies"},
    *   summary="Get currencies",
    *   description="Returns all currencies",
    *   operationId="indexCurrency",
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
    *       description="Show all currencies.",
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
        $currencies=Currency::get()->map(function($currency) {
            return $this->dataCurrency($currency);
        });

        $page=Paginator::resolveCurrentPage('page');
        $pagination=new LengthAwarePaginator($currencies, $total=count($currencies), $perPage=15, $page, ['path' => Paginator::resolveCurrentPath(), 'pageName' => 'page']);
        $pagination=Arr::collapse([$pagination->toArray(), ['code' => 200, 'status' => 'success']]);

        return response()->json($pagination, 200);
    }

    /**
    *
    * @OA\Post(
    *   path="/api/v1/currencies",
    *   tags={"Currencies"},
    *   summary="Register currency",
    *   description="Create a new currency",
    *   operationId="storeCurrency",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="name[es]",
    *       in="query",
    *       description="Name of currency in spanish (The key of the value must be the locale of the language)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="name[en]",
    *       in="query",
    *       description="Name of currency in english (The key of the value must be the locale of the language)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="iso",
    *       in="query",
    *       description="ISO code of currency",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="symbol",
    *       in="query",
    *       description="Symbol of currency",
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
    *       description="Registered currency.",
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
    public function store(CurrencyStoreRequest $request) {
        $trashed=Currency::where('slug', Str::slug(request('name')['es']))->withTrashed()->exists();
        $exist=Currency::where('slug', Str::slug(request('name')['es']))->exists();
        if ($trashed && $exist===false) {
            $currency=Currency::where('slug', Str::slug(request('name')['es']))->withTrashed()->first();
            $currency->restore();
        } else if ($exist) {
            return response()->json(['code' => 422, 'status' => 'error', 'message' => trans('api.errors.422.currency')], 422);
        } else {
            $data=array('name' => request('name'), 'iso' => request('iso'), 'symbol' => request('symbol'));
            $currency=Currency::create($data);
        }
        
        if ($currency) {
            $currency=Currency::where('id', $currency->id)->first();
            $currency=$this->dataCurrency($currency);
            return response()->json(['code' => 201, 'status' => 'success', 'message' => trans('api.currencies.store'), 'data' => $currency], 201);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Get(
    *   path="/api/v1/currencies/{id}",
    *   tags={"Currencies"},
    *   summary="Get currency",
    *   description="Returns a single currency",
    *   operationId="showCurrency",
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
    *       description="Show currency.",
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
    public function show(Currency $currency) {
        $currency=$this->dataCurrency($currency);
        return response()->json(['code' => 200, 'status' => 'success', 'data' => $currency], 200);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/currencies/{id}",
    *   tags={"Currencies"},
    *   summary="Update currency",
    *   description="Update a single currency",
    *   operationId="updateCurrency",
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
    *       description="Name of currency in spanish (The key of the value must be the locale of the language)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="name[en]",
    *       in="query",
    *       description="Name of currency in english (The key of the value must be the locale of the language)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="iso",
    *       in="query",
    *       description="ISO code of currency",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="symbol",
    *       in="query",
    *       description="Symbol of currency",
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
    *       description="Update currency.",
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
    public function update(CurrencyUpdateRequest $request, Currency $currency) {
        $data=array('name' => request('name'), 'iso' => request('iso'), 'symbol' => request('symbol'));
        $currency->fill($data)->save();
        if ($currency) {
            $currency=Currency::where('id', $currency->id)->first();
            $currency=$this->dataCurrency($currency);
            return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.currencies.update'), 'data' => $currency], 200);
        }
        
        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Delete(
    *   path="/api/v1/currencies/{id}",
    *   tags={"Currencies"},
    *   summary="Delete currency",
    *   description="Delete a single currency",
    *   operationId="destroyCurrency",
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
    *       description="Delete currency.",
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
    public function destroy(Currency $currency)
    {
    	$currency->delete();
    	if ($currency) {
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.currencies.destroy')], 200);
    	}

    	return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/currencies/{id}/deactivate",
    *   tags={"Currencies"},
    *   summary="Deactivate currency",
    *   description="Deactivate a single currency",
    *   operationId="deactivateCurrency",
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
    *       description="Deactivate currency.",
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
    public function deactivate(Request $request, Currency $currency) {
    	$currency->fill(['state' => "0"])->save();
    	if ($currency) {
            $currency=$this->dataCurrency($currency);
            return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.currencies.deactivate'), 'data' => $currency], 200);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/currencies/{id}/activate",
    *   tags={"Currencies"},
    *   summary="Activate currency",
    *   description="Activate a single currency",
    *   operationId="activateCurrency",
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
    *       description="Activate currency.",
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
    public function activate(Request $request, Currency $currency) {
    	$currency->fill(['state' => "1"])->save();
    	if ($currency) {
    		$currency=$this->dataCurrency($currency);
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.currencies.activate'), 'data' => $currency], 200);
    	}

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }
}
