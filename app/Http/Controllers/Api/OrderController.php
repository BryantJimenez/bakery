<?php

namespace App\Http\Controllers\Api;

use App\Models\Order\Order;
use JoeDixon\Translation\Language;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Arr;

class OrderController extends ApiController
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
    *   path="/api/v1/orders",
    *   tags={"Orders"},
    *   summary="Get orders",
    *   description="Returns all orders",
    *   operationId="indexOrder",
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
    *       description="Show all orders.",
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
        $orders=Order::with(['user.language', 'currency', 'payment', 'shipping', 'order_products.product.category', 'order_products.complements.complement', 'order_products.complements.group.attribute'])->get()->map(function($order) {
            return $this->dataOrder($order);
        });

        $page=Paginator::resolveCurrentPage('page');
        $pagination=new LengthAwarePaginator($orders, $total=count($orders), $perPage=15, $page, ['path' => Paginator::resolveCurrentPath(), 'pageName' => 'page']);
        $pagination=Arr::collapse([$pagination->toArray(), ['code' => 200, 'status' => 'success']]);

        return response()->json($pagination, 200);
    }

    /**
    *
    * @OA\Get(
    *   path="/api/v1/orders/{id}",
    *   tags={"Orders"},
    *   summary="Get order",
    *   description="Returns a single order",
    *   operationId="showOrder",
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
    *       description="Show order.",
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
    public function show(Order $order) {
        $order=$this->dataOrder($order);
        return response()->json(['code' => 200, 'status' => 'success', 'data' => $order], 200);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/orders/{id}/reject",
    *   tags={"Orders"},
    *   summary="Reject order",
    *   description="Reject a single order",
    *   operationId="rejectOrder",
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
    *       description="Reject order.",
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
    public function reject(Request $request, Order $order) {
    	$order->fill(['state' => "0"])->save();
    	if ($order) {
            $order=$this->dataOrder($order);
            return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.orders.reject'), 'data' => $order], 200);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/orders/{id}/confirm",
    *   tags={"Orders"},
    *   summary="Confirm order",
    *   description="Confirm a single order",
    *   operationId="confirmOrder",
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
    *       description="Confirm order.",
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
    public function confirm(Request $request, Order $order) {
    	$order->fill(['state' => "1"])->save();
    	if ($order) {
    		$order=$this->dataOrder($order);
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.orders.confirm'), 'data' => $order], 200);
    	}

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }
}
