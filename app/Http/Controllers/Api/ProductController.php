<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Product;
use App\Models\Group\Group;
use App\Models\Group\GroupProduct;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Product\ProductStoreRequest;
use App\Http\Requests\Api\Product\ProductUpdateRequest;
use App\Http\Requests\Api\Product\ProductAssignRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Arr;

class ProductController extends ApiController
{
    /**
    *
    * @OA\Get(
    *   path="/api/v1/products",
    *   tags={"Products"},
    *   summary="Get products",
    *   description="Returns all products",
    *   operationId="indexProduct",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Response(
    *       response=200,
    *       description="Show all products.",
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
      $products=Product::with(['category', 'groups.complements'])->get()->map(function($product) {
         return $this->dataProduct($product);
     });

      $page=Paginator::resolveCurrentPage('page');
      $pagination=new LengthAwarePaginator($products, $total=count($products), $perPage=15, $page, ['path' => Paginator::resolveCurrentPath(), 'pageName' => 'page']);
      $pagination=Arr::collapse([$pagination->toArray(), ['code' => 200, 'status' => 'success']]);

      return response()->json($pagination, 200);
  }

    /**
    *
    * @OA\Post(
    *   path="/api/v1/products",
    *   tags={"Products"},
    *   summary="Register product",
    *   description="Create a new product",
    *   operationId="storeProduct",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="name",
    *       in="query",
    *       description="Name of product",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="description",
    *       in="query",
    *       description="Description of product",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="price",
    *       in="query",
    *       description="Price of product",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           format="float"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="category_id",
    *       in="query",
    *       description="Categorie ID",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="state",
    *       in="query",
    *       description="State of product (0=Inactive, 1=Active, 2=Not Available, 3=Out of Stock)",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           enum={"1", "2", "3", "0"}
    *       )
    *   ),
    *   @OA\Response(
    *       response=201,
    *       description="Registered product.",
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
    public function store(ProductStoreRequest $request) {
        $data=array('name' => request('name'), 'description' => request('description'), 'price' => request('price'), 'state' => request('state'), 'category_id' => request('category_id'));
    	$product=Product::create($data);

    	if ($product) {
            $product=Product::with(['category'])->where('id', $product->id)->first();
            $product=$this->dataProduct($product);

            return response()->json(['code' => 201, 'status' => 'success', 'message' => 'El producto ha sido registrado exitosamente.', 'data' => $product], 201);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'], 500);
    }

    /**
    *
    * @OA\Get(
    *   path="/api/v1/products/{id}",
    *   tags={"Products"},
    *   summary="Get product",
    *   description="Returns a single product",
    *   operationId="showProduct",
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
    *       description="Show product.",
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
    public function show(Product $product) {
    	$product=$this->dataProduct($product);
    	return response()->json(['code' => 200, 'status' => 'success', 'data' => $product], 200);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/products/{id}",
    *   tags={"Products"},
    *   summary="Update product",
    *   description="Update a single product",
    *   operationId="updateProduct",
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
    *       description="Name of product",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="description",
    *       in="query",
    *       description="Description of product",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="price",
    *       in="query",
    *       description="Price of product",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           format="float"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="category_id",
    *       in="query",
    *       description="Categorie ID",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="state",
    *       in="query",
    *       description="State of product (0=Inactive, 1=Active, 2=Not Available, 3=Out of Stock)",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           enum={"1", "2", "3", "0"}
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Update product.",
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
    public function update(ProductUpdateRequest $request, Product $product) {
        $data=array('name' => request('name'), 'description' => request('description'), 'price' => request('price'), 'state' => request('state'), 'category_id' => request('category_id'));
    	$product->fill($data)->save();        

    	if ($product) {
            $product=Product::with(['category'])->where('id', $product->id)->first();
            $product=$this->dataProduct($product);

            return response()->json(['code' => 200, 'status' => 'success', 'message' => 'El producto ha sido editado exitosamente.', 'data' => $product], 200);
        }
        
        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'], 500);
    }

    /**
    *
    * @OA\Delete(
    *   path="/api/v1/products/{id}",
    *   tags={"Products"},
    *   summary="Delete product",
    *   description="Delete a single product",
    *   operationId="destroyProduct",
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
    *       description="Delete product.",
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
    public function destroy(Product $product)
    {
    	$product->delete();
    	if ($product) {
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => 'El producto ha sido eliminado exitosamente.'], 200);
    	}

        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/products/{id}/deactivate",
    *   tags={"Products"},
    *   summary="Deactivate product",
    *   description="Deactivate a single product",
    *   operationId="deactivateProduct",
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
    *       description="Deactivate product.",
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
    public function deactivate(Request $request, Product $product) {
    	$product->fill(['state' => "0"])->save();
    	if ($product) {
    		$product=$this->dataProduct($product);
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => 'El producto ha sido desactivado exitosamente.', 'data' => $product], 200);
    	}

        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/products/{id}/activate",
    *   tags={"Products"},
    *   summary="Activate product",
    *   description="Activate a single product",
    *   operationId="activateProduct",
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
    *       description="Activate product.",
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
    public function activate(Request $request, Product $product) {
    	$product->fill(['state' => "1"])->save();
    	if ($product) {
    		$product=$this->dataProduct($product);
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => 'El producto ha sido activado exitosamente.', 'data' => $product], 200);
    	}
        
    	return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/products/{id}/assign",
    *   tags={"Products"},
    *   summary="Assign groups to product",
    *   description="assign groups to a single product",
    *   operationId="assignProduct",
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
    *       name="group_id[0]",
    *       in="query",
    *       description="Group ID",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Assign groups to product.",
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
    public function assign(ProductAssignRequest $request, Product $product) {  
        $assign=true;      
        GroupProduct::where('product_id', $product->id)->delete();
        foreach (request('group_id') as $value) {
            $group=Group::where('id', $value)->first();
            if (!is_null($group)) {
                $data=array('product_id' => $product->id, 'group_id' => $group->id);
                $group_product=GroupProduct::create($data);
                if (!$group_product) {
                    $assign=false;
                }
            }
        }

        if ($assign) {
            $product=Product::where('id', $product->id)->first();
            $product=$this->dataProduct($product);
            return response()->json(['code' => 200, 'status' => 'success', 'message' => 'Los grupos han sido asignados exitosamente.', 'data' => $product], 200);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'], 500);
    }
}
