<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Http\Requests\Agency\AgencyStoreRequest;
use App\Http\Requests\Agency\AgencyUpdateRequest;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $agencies=Agency::orderBy('id', 'DESC')->get();
        return view('admin.agencies.index', compact('agencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.agencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgencyStoreRequest $request) {
        $data=array('name' => request('name'), 'route' => request('route'), 'description' => request('description'), 'price' => request('price'));
        $agency=Agency::create($data);
        if ($agency) {
            return redirect()->route('agencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.store'), 'msg' => trans('admin.notifications.success.messages.agencies.store')]);
        } else {
            return redirect()->route('agencies.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.store'), 'msg' => trans('admin.notifications.error.500')])->withInputs();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Agency $agency) {
        return view('admin.agencies.edit', compact("agency"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AgencyUpdateRequest $request, Agency $agency) {
        $data=array('name' => request('name'), 'route' => request('route'), 'description' => request('description'), 'price' => request('price'));
        $agency->fill($data)->save();
        if ($agency) {
            return redirect()->route('agencies.edit', ['agency' => $agency->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.agencies.update')]);
        } else {
            return redirect()->route('agencies.edit', ['agency' => $agency->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agency $agency) {
        $agency->delete();
        if ($agency) {
            return redirect()->route('agencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.destroy'), 'msg' => trans('admin.notifications.success.messages.agencies.destroy')]);
        } else {
            return redirect()->route('agencies.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.destroy'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    public function deactivate(Request $request, Agency $agency) {
        $agency->fill(['state' => "0"])->save();
        if ($agency) {
            return redirect()->route('agencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.agencies.deactivate')]);
        } else {
            return redirect()->route('agencies.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    public function activate(Request $request, Agency $agency) {
        $agency->fill(['state' => "1"])->save();
        if ($agency) {
            return redirect()->route('agencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.agencies.activate')]);
        } else {
            return redirect()->route('agencies.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }
}
