<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Complement;
use App\Models\Group\Group;
use App\Models\Group\ComplementGroup;
use App\Http\Requests\Group\GroupStoreRequest;
use App\Http\Requests\Group\GroupUpdateRequest;
use App\Http\Requests\Group\GroupAssignRequest;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $groups=Group::with(['attribute'])->orderBy('id', 'DESC')->get();
        return view('admin.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $attributes=Attribute::where('state', '1')->orderBy('name', 'ASC')->get();
        return view('admin.groups.create', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupStoreRequest $request) {
        $attribute=Attribute::where('slug', request('attribute_id'))->first();
        $data=array('name' => request('name'), 'condition' => request('condition'), 'min' => request('min'), 'max' => request('max'), 'state' => request('state'), 'attribute_id' => $attribute->id);
        $group=Group::create($data);

        if ($group) {
            return redirect()->route('groups.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful registration', 'msg' => 'The group has been successfully registered.']);
        } else {
            return redirect()->route('groups.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed registration', 'msg' => 'An error occurred during the process, please try again.'])->withInputs();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group) {
        return view('admin.groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group) {
        $attributes=Attribute::where('state', '1')->orderBy('name', 'ASC')->get();
        return view('admin.groups.edit', compact("group", "attributes"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupUpdateRequest $request, Group $group) {
        $attribute=Attribute::where('slug', request('attribute_id'))->first();
        $data=array('name' => request('name'), 'condition' => request('condition'), 'min' => request('min'), 'max' => request('max'), 'state' => request('state'), 'attribute_id' => $attribute->id);
        $group->fill($data)->save();

        if ($group) {
            return redirect()->route('groups.edit', ['group' => $group->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful editing', 'msg' => 'The group has been edited successfully.']);
        } else {
            return redirect()->route('groups.edit', ['group' => $group->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred during the process, please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group) {
        $group->delete();
        if ($group) {
            return redirect()->route('groups.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful removal', 'msg' => 'The group has been successfully removed.']);
        } else {
            return redirect()->route('groups.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed deletion', 'msg' => 'An error occurred during the process, please try again.']);
        }
    }

    public function deactivate(Request $request, Group $group) {
        $group->fill(['state' => "0"])->save();
        if ($group) {
            return redirect()->route('groups.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful editing', 'msg' => 'The group has been successfully deactivated.']);
        } else {
            return redirect()->route('groups.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred during the process, please try again.']);
        }
    }

    public function activate(Request $request, Group $group) {
        $group->fill(['state' => "1"])->save();
        if ($group) {
            return redirect()->route('groups.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful editing', 'msg' => 'The group has been activated successfully.']);
        } else {
            return redirect()->route('groups.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred during the process, please try again.']);
        }
    }

    public function assign(Group $group) {
        $complements=Complement::where('state', '1')->orderBy('name', 'ASC')->get();
        return view('admin.groups.assign', compact("group", "complements"));
    }

    public function assignComplements(GroupAssignRequest $request, Group $group) {
        $num=0;
        $assign=true;
        ComplementGroup::where('group_id', $group->id)->delete();
        foreach (request('complement_id') as $value) {
            $complement=Complement::where('slug', $value)->first();
            if (!is_null($complement)) {
                $data=array('price' => request('price')[$num], 'state' => request('state')[$num], 'group_id' => $group->id, 'complement_id' => $complement->id);
                $complement_group=ComplementGroup::create($data);
                if (!$complement_group) {
                    $assign=false;
                }
            }
            $num++;
        }

        if ($assign) {
            return redirect()->route('groups.assign', ['group' => $group->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful editing', 'msg' => 'The complements has been assigned successfully.']);
        } else {
            return redirect()->route('groups.assign', ['group' => $group->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred during the process, please try again.']);
        }
    }

    public function complements() {
        $complements=Complement::where('state', '1')->orderBy('name', 'DESC')->get();
        return response()->json(['status' => true, 'complements' => $complements]);
    }
}
