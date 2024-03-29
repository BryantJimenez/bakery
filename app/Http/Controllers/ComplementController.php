<?php

namespace App\Http\Controllers;

use App\Models\Complement;
use App\Http\Requests\Complement\ComplementStoreRequest;
use App\Http\Requests\Complement\ComplementUpdateRequest;
use Illuminate\Http\Request;

class ComplementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $complements=Complement::orderBy('id', 'DESC')->get();
        return view('admin.complements.index', compact('complements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.complements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplementStoreRequest $request) {
        $data=array('name' => request('name'), 'description' => request('description'), 'price' => request('price'));
        $complement=Complement::create($data);

        if ($complement) {
            // Move image to complements folder and extract name
            if ($request->hasFile('image')) {
                $file=$request->file('image');
                $image=store_files($file, $complement->slug, '/admins/img/complements/');
                $complement->fill(['image' => $image])->save();
            }

            return redirect()->route('complements.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.store'), 'msg' => trans('admin.notifications.success.messages.complements.store')]);
        } else {
            return redirect()->route('complements.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.store'), 'msg' => trans('admin.notifications.error.500')])->withInputs();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Complement $complement) {
        return view('admin.complements.show', compact('complement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Complement $complement) {
        return view('admin.complements.edit', compact("complement"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ComplementUpdateRequest $request, Complement $complement) {
        $data=array('name' => request('name'), 'description' => request('description'), 'price' => request('price'));
        $complement->fill($data)->save();

        if ($complement) {
            // Move image to complements folder and extract name
            if ($request->hasFile('image')) {
                $file=$request->file('image');
                $image=store_files($file, $complement->slug, '/admins/img/complements/');
                $complement->fill(['image' => $image])->save();
            }

            return redirect()->route('complements.edit', ['complement' => $complement->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.complements.update')]);
        } else {
            return redirect()->route('complements.edit', ['complement' => $complement->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Complement  $complement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complement $complement) {
        $complement->delete();
        if ($complement) {
            return redirect()->route('complements.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.destroy'), 'msg' => trans('admin.notifications.success.messages.complements.destroy')]);
        } else {
            return redirect()->route('complements.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.destroy'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    public function deactivate(Request $request, Complement $complement) {
        $complement->fill(['state' => "0"])->save();
        if ($complement) {
            return redirect()->route('complements.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.complements.deactivate')]);
        } else {
            return redirect()->route('complements.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    public function activate(Request $request, Complement $complement) {
        $complement->fill(['state' => "1"])->save();
        if ($complement) {
            return redirect()->route('complements.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.complements.activate')]);
        } else {
            return redirect()->route('complements.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }
}
