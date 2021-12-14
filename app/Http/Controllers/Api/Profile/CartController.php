<?php

namespace App\Http\Controllers\Api\Profile;

use App\Models\Product;
use App\Models\Cart\Cart;
use App\Models\Cart\CartProduct;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Cart\CartStoreRequest;
use Illuminate\Http\Request;
use App\Traits\CartTrait;
use Auth;

class CartController extends ApiController
{
    use CartTrait;

    /**
    *
    * @OA\Get(
    *   path="/api/v1/cart",
    *   tags={"Cart"},
    *   summary="Get cart",
    *   description="Returns cart data",
    *   operationId="getCart",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Response(
    *       response=200,
    *       description="Get cart.",
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
    public function get() {
        $cart=Cart::with(['products.product.category', 'products.complements.complement', 'products.complements.group.attribute'])->where('user_id', Auth::id())->first();
        $data=$this->dataCart($cart);
        return response()->json(['code' => 200, 'status' => 'success', 'data' => $data], 200);
    }

    /**
    *
    * @OA\Post(
    *   path="/api/v1/cart",
    *   tags={"Cart"},
    *   summary="Add product to cart",
    *   description="Add a new product in the cart",
    *   operationId="storeCart",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="product_id",
    *       in="query",
    *       description="Product ID",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="complement_group_id[0]",
    *       in="query",
    *       description="Complement Group ID",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Response(
    *       response=201,
    *       description="Add product to cart.",
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
    public function store(CartStoreRequest $request) {
        $product=Product::where('id', request('product_id'))->first();
        $cart_product=$this->addCart($product, request('complement_group_id'));

        if ($cart_product) {
            $cart_product=CartProduct::where('id', $cart_product->id)->first();
            $cart_product=$this->dataCartProduct($cart_product);
            return response()->json(['code' => 201, 'status' => 'success', 'message' => 'El producto ha sido agragado al carrito exitosamente.', 'data' => $cart_product], 201);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/cart/{id}/add",
    *   tags={"Cart"},
    *   summary="Add a product to cart",
    *   description="Add a single product of cart",
    *   operationId="addCart",
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
    *       description="Add a product to cart.",
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
    public function add(CartProduct $cart_product) {
        $cart=$this->plusCartDatabase($cart_product->code);
        if ($cart) {
            $cart_product=CartProduct::where('id', $cart_product->id)->first();
            $cart_product=$this->dataCartProduct($cart_product);

            return response()->json(['code' => 200, 'status' => 'success', 'message' => 'El producto ha sido agregado al carrito exitosamente.', 'data' => $cart_product], 200);
        }
        
        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/cart/{id}/remove",
    *   tags={"Cart"},
    *   summary="Remove a product to cart",
    *   description="Remove a single product of cart",
    *   operationId="removeCart",
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
    *       description="Add a product to cart.",
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
    public function remove(CartProduct $cart_product) {
        $cart=$this->minusCartDatabase($cart_product->code);
        if ($cart) {
            $cart_product=CartProduct::where('id', $cart_product->id)->first();
            $cart_product=$this->dataCartProduct($cart_product);

            return response()->json(['code' => 200, 'status' => 'success', 'message' => 'El producto ha sido removido al carrito exitosamente.', 'data' => $cart_product], 200);
        }
        
        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'], 500);
    }

    /**
    *
    * @OA\Delete(
    *   path="/api/v1/cart/{id}",
    *   tags={"Cart"},
    *   summary="Delete product of cart",
    *   description="Delete a single product of cart",
    *   operationId="destroyCart",
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
    *       description="Delete product of cart.",
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
    public function destroy(CartProduct $cart_product)
    {
        $cart=$this->removeCartDatabase($cart_product->code);
        if ($cart) {
            return response()->json(['code' => 200, 'status' => 'success', 'message' => 'El producto ha sido eliminado del carrito exitosamente.'], 200);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'], 500);
    }
}
