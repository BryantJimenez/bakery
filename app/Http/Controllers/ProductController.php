<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Group\Group;
use App\Models\Group\GroupProduct;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Requests\Product\ProductAssignRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products=Product::with(['category'])->orderBy('id', 'DESC')->get();
        $groups=Group::where('state', '1')->orderBy('name', 'ASC')->get();
        return view('admin.products.index', compact('products', 'groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories=Category::where('state', '1')->orderBy('name', 'ASC')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request) {
        $category=Category::where('slug', request('category_id'))->first();
        $data=array('name' => request('name'), 'description' => request('description'), 'price' => request('price'), 'state' => request('state'), 'category_id' => $category->id);
        $product=Product::create($data);

        if ($product) {
            // Move image to products folder and extract name
            if ($request->hasFile('image')) {
                $file=$request->file('image');
                $image=store_files($file, $product->slug, '/admins/img/products/');
                $product->fill(['image' => $image])->save();
            }

            return redirect()->route('products.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El producto ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('products.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product) {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product) {
        $categories=Category::where('state', '1')->orderBy('name', 'ASC')->get();
        return view('admin.products.edit', compact("product", "categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product) {
        $category=Category::where('slug', request('category_id'))->first();
        $data=array('name' => request('name'), 'description' => request('description'), 'price' => request('price'), 'state' => request('state'), 'category_id' => $category->id);
        $product->fill($data)->save();

        if ($product) {
            // Move image to products folder and extract name
            if ($request->hasFile('image')) {
                $file=$request->file('image');
                $image=store_files($file, $product->slug, '/admins/img/products/');
                $product->fill(['image' => $image])->save();
            }

            return redirect()->route('products.edit', ['product' => $product->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El producto ha sido editado exitosamente.']);
        } else {
            return redirect()->route('products.edit', ['product' => $product->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product) {
        $product->delete();
        if ($product) {
            return redirect()->route('products.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El producto ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('products.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, Product $product) {
        $product->fill(['state' => "0"])->save();
        if ($product) {
            return redirect()->route('products.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El producto ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('products.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, Product $product) {
        $product->fill(['state' => "1"])->save();
        if ($product) {
            return redirect()->route('products.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El producto ha sido activado exitosamente.']);
        } else {
            return redirect()->route('products.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function groups(Product $product) {
        $groups=$product['groups']->map(function($group) {
            return array($group->slug);
        });
        return response()->json(['status' => true, 'groups' => $groups]);
    }

    public function assign(ProductAssignRequest $request, Product $product) {  
        $assign=true;      
        GroupProduct::where('product_id', $product->id)->delete();
        foreach (request('group_id') as $value) {
            $group=Group::where('slug', $value)->first();
            if (!is_null($group)) {
                $data=array('product_id' => $product->id, 'group_id' => $group->id);
                $group_product=GroupProduct::create($data);
                if (!$group_product) {
                    $assign=false;
                }
            }
        }

        if ($assign) {
            return redirect()->route('products.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El grupo de complementos se ha asignado exitosamente.']);
        } else {
            return redirect()->route('products.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
