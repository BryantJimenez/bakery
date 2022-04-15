<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Http\Requests\Attribute\AttributeStoreRequest;
use App\Http\Requests\Attribute\AttributeUpdateRequest;
use Illuminate\Http\Request;
use Str;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $attributes=Attribute::orderBy('id', 'DESC')->get();
        return view('admin.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeStoreRequest $request) {
        $trashed=Attribute::where('slug', Str::slug(request('name')['es']))->withTrashed()->exists();
        $exist=Attribute::where('slug', Str::slug(request('name')['es']))->exists();
        if ($trashed && $exist===false) {
            $attribute=Attribute::where('slug', Str::slug(request('name')['es']))->withTrashed()->first();
            $attribute->restore();
        } else if ($exist) {
            return redirect()->route('attributes.index')->with(['alert' => 'lobibox', 'type' => 'warning', 'title' => trans('admin.notifications.error.messages.attributes.422.title'), 'msg' => trans('admin.notifications.error.messages.attributes.422.msg')]);
        } else {
            $attribute=Attribute::create(['name' => request('name')]);
        }

        if ($attribute) {
            return redirect()->route('attributes.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.store'), 'msg' => trans('admin.notifications.success.messages.attributes.store')]);
        } else {
            return redirect()->route('attributes.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.store'), 'msg' => trans('admin.notifications.error.500')])->withInputs();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute) {
        return view('admin.attributes.edit', compact("attribute"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeUpdateRequest $request, Attribute $attribute) {
        $attribute->fill(['name' => request('name')])->save();
        if ($attribute) {
            return redirect()->route('attributes.edit', ['attribute' => $attribute->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.attributes.update')]);
        } else {
            return redirect()->route('attributes.edit', ['attribute' => $attribute->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute) {
        $attribute->delete();
        if ($attribute) {
            return redirect()->route('attributes.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.destroy'), 'msg' => trans('admin.notifications.success.messages.attributes.destroy')]);
        } else {
            return redirect()->route('attributes.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.destroy'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    public function deactivate(Request $request, Attribute $attribute) {
        $attribute->fill(['state' => "0"])->save();
        if ($attribute) {
            return redirect()->route('attributes.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.attributes.deactivate')]);
        } else {
            return redirect()->route('attributes.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    public function activate(Request $request, Attribute $attribute) {
        $attribute->fill(['state' => "1"])->save();
        if ($attribute) {
            return redirect()->route('attributes.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.attributes.activate')]);
        } else {
            return redirect()->route('attributes.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }
}
