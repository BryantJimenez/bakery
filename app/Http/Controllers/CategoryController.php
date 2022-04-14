<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use Illuminate\Http\Request;
use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $categories=Category::orderBy('id', 'DESC')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request) {
        $trashed=Category::where('slug', Str::slug(request('name')))->withTrashed()->exists();
        $exist=Category::where('slug', Str::slug(request('name')))->exists();
        if ($trashed && $exist===false) {
            $category=Category::where('slug', Str::slug(request('name')))->withTrashed()->first();
            $category->restore();
        } else if ($exist) {
            return redirect()->route('categories.index')->with(['alert' => 'lobibox', 'type' => 'warning', 'title' => trans('admin.notifications.error.messages.categories.422.title'), 'msg' => trans('admin.notifications.error.messages.categories.422.msg')]);
        } else {
            $category=Category::create(['name' => request('name')]);
        }

        if ($category) {
            // Move image to categories folder and extract name
            if ($request->hasFile('image')) {
                $file=$request->file('image');
                $image=store_files($file, $category->slug, '/admins/img/categories/');
                $category->fill(['image' => $image])->save();
            }

            return redirect()->route('categories.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.store'), 'msg' => trans('admin.notifications.success.messages.categories.store')]);
        } else {
            return redirect()->route('categories.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.store'), 'msg' => trans('admin.notifications.error.500')])->withInputs();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category) {
        return view('admin.categories.edit', compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, Category $category) {
        $category->fill(['name' => request('name')])->save();
        if ($category) {
            // Move image to categories folder and extract name
            if ($request->hasFile('image')) {
                $file=$request->file('image');
                $image=store_files($file, $category->slug, '/admins/img/categories/');
                $category->fill(['image' => $image])->save();
            }

            return redirect()->route('categories.edit', ['category' => $category->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.categories.update')]);
        } else {
            return redirect()->route('categories.edit', ['category' => $category->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category) {
        $category->delete();
        if ($category) {
            return redirect()->route('categories.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.destroy'), 'msg' => trans('admin.notifications.success.messages.categories.destroy')]);
        } else {
            return redirect()->route('categories.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.destroy'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    public function deactivate(Request $request, Category $category) {
        $category->fill(['state' => "0"])->save();
        if ($category) {
            return redirect()->route('categories.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.categories.deactivate')]);
        } else {
            return redirect()->route('categories.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    public function activate(Request $request, Category $category) {
        $category->fill(['state' => "1"])->save();
        if ($category) {
            return redirect()->route('categories.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.categories.activate')]);
        } else {
            return redirect()->route('categories.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }
}
