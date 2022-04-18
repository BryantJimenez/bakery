<?php

namespace App\Http\Controllers\Api;

use App\Models\Complement;
use App\Models\Group\Group;
use JoeDixon\Translation\Language;
use App\Models\Group\ComplementGroup;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Group\GroupStoreRequest;
use App\Http\Requests\Api\Group\GroupUpdateRequest;
use App\Http\Requests\Api\Group\GroupAssignRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Arr;

class GroupController extends ApiController
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if ($request->has('locale') && !is_null($request->locale)) {
                $language=Language::where('language', $request->locale)->first();
                if (!is_null($language)) {
                    app()->setLocale($language->language);
                }
            }
            return $next($request);
        });
    }

    /**
    *
    * @OA\Get(
    *   path="/api/v1/groups",
    *   tags={"Groups"},
    *   summary="Get groups",
    *   description="Returns all groups",
    *   operationId="indexGroup",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="page",
    *       in="query",
    *       description="Number of page",
    *       required=false,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="locale",
    *       in="query",
    *       description="Locale for example ('es','en')",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Show all groups.",
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
    public function index(Request $request) {
        $groups=Group::with(['attribute', 'complements'])->get()->map(function($group) {
            return $this->dataGroup($group);
        });

        $page=Paginator::resolveCurrentPage('page');
        $pagination=new LengthAwarePaginator($groups, $total=count($groups), $perPage=15, $page, ['path' => Paginator::resolveCurrentPath(), 'pageName' => 'page']);
        $pagination=Arr::collapse([$pagination->toArray(), ['code' => 200, 'status' => 'success']]);

        return response()->json($pagination, 200);
    }

    /**
    *
    * @OA\Post(
    *   path="/api/v1/groups",
    *   tags={"Groups"},
    *   summary="Register group",
    *   description="Create a new group",
    *   operationId="storeGroup",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="name[es]",
    *       in="query",
    *       description="Name of group in spanish (The key of the value must be the locale of the language)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="name[en]",
    *       in="query",
    *       description="Name of group in english (The key of the value must be the locale of the language)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="condition",
    *       in="query",
    *       description="Condition of group (0=Optional, 1=Required)",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           enum={"1", "0"}
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="min",
    *       in="query",
    *       description="Minimum options to select from group",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="max",
    *       in="query",
    *       description="Maximun options to select from group",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="state",
    *       in="query",
    *       description="State of group (0=Inactive, 1=Active)",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           enum={"1", "0"}
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="attribute_id",
    *       in="query",
    *       description="Attribute ID",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="locale",
    *       in="query",
    *       description="Locale for example ('es','en')",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Response(
    *       response=201,
    *       description="Registered group.",
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
    public function store(GroupStoreRequest $request) {
        $data=array('name' => request('name'), 'condition' => request('condition'), 'min' => request('min'), 'max' => request('max'), 'state' => request('state'), 'attribute_id' => request('attribute_id'));
    	$group=Group::create($data);

    	if ($group) {
            $group=Group::where('id', $group->id)->first();
            $group=$this->dataGroup($group);

            return response()->json(['code' => 201, 'status' => 'success', 'message' => trans('api.groups.store'), 'data' => $group], 201);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Get(
    *   path="/api/v1/groups/{id}",
    *   tags={"Groups"},
    *   summary="Get group",
    *   description="Returns a single group",
    *   operationId="showGroup",
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
    *       name="locale",
    *       in="query",
    *       description="Locale for example ('es','en')",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Show group.",
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
    public function show(Group $group) {
    	$group=$this->dataGroup($group);
    	return response()->json(['code' => 200, 'status' => 'success', 'data' => $group], 200);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/groups/{id}",
    *   tags={"Groups"},
    *   summary="Update group",
    *   description="Update a single group",
    *   operationId="updateGroup",
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
    *       name="name[es]",
    *       in="query",
    *       description="Name of group in spanish (The key of the value must be the locale of the language)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="name[en]",
    *       in="query",
    *       description="Name of group in english (The key of the value must be the locale of the language)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="condition",
    *       in="query",
    *       description="Condition of group (0=Optional, 1=Required)",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           enum={"1", "0"}
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="min",
    *       in="query",
    *       description="Minimum options to select from group",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="max",
    *       in="query",
    *       description="Maximun options to select from group",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="state",
    *       in="query",
    *       description="State of group (0=Inactive, 1=Active)",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           enum={"1", "0"}
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="attribute_id",
    *       in="query",
    *       description="Attribute ID",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="locale",
    *       in="query",
    *       description="Locale for example ('es','en')",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
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
    public function update(GroupUpdateRequest $request, Group $group) {
        $data=array('name' => request('name'), 'condition' => request('condition'), 'min' => request('min'), 'max' => request('max'), 'state' => request('state'), 'attribute_id' => request('attribute_id'));
    	$group->fill($data)->save();        

    	if ($group) {
            $group=Group::where('id', $group->id)->first();
            $group=$this->dataGroup($group);

            return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.groups.update'), 'data' => $group], 200);
        }
        
        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Delete(
    *   path="/api/v1/groups/{id}",
    *   tags={"Groups"},
    *   summary="Delete group",
    *   description="Delete a single group",
    *   operationId="destroyGroup",
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
    *       name="locale",
    *       in="query",
    *       description="Locale for example ('es','en')",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Delete group.",
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
    public function destroy(Group $group)
    {
    	$group->delete();
    	if ($group) {
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.groups.destroy')], 200);
    	}

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/groups/{id}/deactivate",
    *   tags={"Groups"},
    *   summary="Deactivate group",
    *   description="Deactivate a single group",
    *   operationId="deactivateGroup",
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
    *       name="locale",
    *       in="query",
    *       description="Locale for example ('es','en')",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Deactivate group.",
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
    public function deactivate(Request $request, Group $group) {
    	$group->fill(['state' => "0"])->save();
    	if ($group) {
    		$group=$this->dataGroup($group);
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.groups.deactivate'), 'data' => $group], 200);
    	}

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/groups/{id}/activate",
    *   tags={"Groups"},
    *   summary="Activate group",
    *   description="Activate a single group",
    *   operationId="activateGroup",
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
    *       name="locale",
    *       in="query",
    *       description="Locale for example ('es','en')",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Activate group.",
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
    public function activate(Request $request, Group $group) {
    	$group->fill(['state' => "1"])->save();
    	if ($group) {
    		$group=$this->dataGroup($group);
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.groups.activate'), 'data' => $group], 200);
    	}
        
    	return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/groups/{id}/assign",
    *   tags={"Groups"},
    *   summary="Assign complements to group",
    *   description="assign complements to a single group",
    *   operationId="assignGroup",
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
    *       name="complement_id[0]",
    *       in="query",
    *       description="Complement ID",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="price[0]",
    *       in="query",
    *       description="Price of complement",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           format="float"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="state[0]",
    *       in="query",
    *       description="State of complement (0=Not Visible, 1=Available, 2=Not Available, 3=Out of Stock)",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           enum={"1", "2", "3", "0"}
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="locale",
    *       in="query",
    *       description="Locale for example ('es','en')",
    *       required=false,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Assign complements to group.",
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
    public function assign(GroupAssignRequest $request, Group $group) {
        $num=0;
        $assign=true;
        ComplementGroup::where('group_id', $group->id)->delete();
        foreach (request('complement_id') as $value) {
            $complement=Complement::where('id', $value)->first();
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
            $group=Group::where('id', $group->id)->first();
            $group=$this->dataGroup($group);
            return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.groups.assign'), 'data' => $group], 200);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }
}
