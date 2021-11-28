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
            return redirect()->route('agencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful registration', 'msg' => 'The agency has been successfully registered.']);
        } else {
            return redirect()->route('agencies.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed registration', 'msg' => 'An error occurred during the process, please try again.'])->withInputs();
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
            return redirect()->route('agencies.edit', ['agency' => $agency->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful editing', 'msg' => 'The agency has been edited successfully.']);
        } else {
            return redirect()->route('agencies.edit', ['agency' => $agency->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred during the process, please try again.']);
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
            return redirect()->route('agencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful removal', 'msg' => 'The agency has been successfully removed.']);
        } else {
            return redirect()->route('agencies.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed deletion', 'msg' => 'An error occurred during the process, please try again.']);
        }
    }

    public function deactivate(Request $request, Agency $agency) {
        $agency->fill(['state' => "0"])->save();
        if ($agency) {
            return redirect()->route('agencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful editing', 'msg' => 'The agency has been successfully deactivated.']);
        } else {
            return redirect()->route('agencies.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred during the process, please try again.']);
        }
    }

    public function activate(Request $request, Agency $agency) {
        $agency->fill(['state' => "1"])->save();
        if ($agency) {
            return redirect()->route('agencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful editing', 'msg' => 'The agency has been activated successfully.']);
        } else {
            return redirect()->route('agencies.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred during the process, please try again.']);
        }
    }
}
