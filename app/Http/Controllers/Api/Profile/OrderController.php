<?php

namespace App\Http\Controllers\Api\Profile;

use App\Models\Order\Order;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;
use Arr;

class OrderController extends ApiController
{
    /**
    *
    * @OA\Get(
    *   path="/api/v1/profile/orders",
    *   tags={"Profile Orders"},
    *   summary="Get profile orders",
    *   description="Returns all profile orders",
    *   operationId="indexProfileOrder",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Response(
    *       response=200,
    *       description="Show all profile orders.",
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
    public function get() {
        $orders=Order::with(['user', 'currency', 'payment', 'shipping', 'order_products.product.category', 'order_products.complements.complement', 'order_products.complements.group.attribute'])->where('user_id', Auth::id())->get()->map(function($order) {
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
    *   path="/api/v1/profile/orders/{id}",
    *   tags={"Profile Orders"},
    *   summary="Get profile order",
    *   description="Returns a single profile order",
    *   operationId="showProfileOrder",
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
    *       description="Show profile order.",
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
        if (Auth::id()!=$order->user_id) {
            return response()->json(['code' => 403, 'status' => 'error', 'message' => trans('errors.exceptions.403')], 403);
        }

        $order=$this->dataOrder($order);
        return response()->json(['code' => 200, 'status' => 'success', 'data' => $order], 200);
    }
}
