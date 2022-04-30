<?php

namespace App\Http\Controllers\Api;

use App\Models\Schedule;
use JoeDixon\Translation\Language;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Schedule\ScheduleStoreRequest;
use App\Http\Requests\Api\Schedule\ScheduleUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Arr;

class ScheduleController extends ApiController
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
    *   path="/api/v1/schedules",
    *   tags={"Schedules"},
    *   summary="Get schedules",
    *   description="Returns all schedules",
    *   operationId="indexSchedule",
    *   security={
    *       {"bearerAuth": {}}
    *   },
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
    *       description="Show all schedules.",
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
        $schedules=Schedule::get()->map(function($schedule) {
            return $this->dataSchedule($schedule);
        });
        return response()->json(['code' => 200, 'status' => 'success', 'data' => $schedules], 200);
    }

    /**
    *
    * @OA\Post(
    *   path="/api/v1/schedules",
    *   tags={"Schedules"},
    *   summary="Register schedule",
    *   description="Create a new schedule",
    *   operationId="storeSchedule",
    *   security={
    *       {"bearerAuth": {}}
    *   },
    *   @OA\Parameter(
    *       name="start",
    *       in="query",
    *       description="Start time of schedule (H:i)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="end",
    *       in="query",
    *       description="End time of schedule (H:i)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="days[]",
    *       in="query",
    *       description="Days of schedule (1=Monday, 2=Tuesday, 3=Wednesday, 4=Thursday, 5=Friday, 6=Saturday, 7=Sunday)",
    *       required=true,
    *       @OA\Schema(
    *           type="array",
    *           @OA\Items(type="integer")
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
    *       description="Registered schedule.",
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
    public function store(ScheduleStoreRequest $request) {
        $schedules=Schedule::where([['start', '>=', request('start')], ['start', '<=', request('end')], ['state', '1']])->orWhere([['end', '>=', request('start')], ['end', '<=', request('end')], ['state', '1']])->orWhere([['start', '<=', request('start')], ['end', '>=', request('end')], ['state', '1']])->orWhere([['start', '>=', request('start')], ['end', '<=', request('end')], ['state', '1']])->get();
        foreach ($schedules as $schedule) {
            foreach ($schedule->days as $day) {
                foreach (request('days') as $selected) {
                    if ($day==$selected) {
                        return response()->json(['code' => 422, 'status' => 'error', 'message' => trans('api.errors.422.schedule')], 422);
                    }
                }
            }
        }

        $data=array('start' => request('start'), 'end' => request('end'), 'days' => request('days'));
        $schedule=Schedule::create($data);
        if ($schedule) {
            $schedule=Schedule::where('id', $schedule->id)->first();
            $schedule=$this->dataSchedule($schedule);
            return response()->json(['code' => 201, 'status' => 'success', 'message' => trans('api.schedules.store'), 'data' => $schedule], 201);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Get(
    *   path="/api/v1/schedules/{id}",
    *   tags={"Schedules"},
    *   summary="Get schedule",
    *   description="Returns a single schedule",
    *   operationId="showSchedule",
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
    *       description="Show schedule.",
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
    public function show(Schedule $schedule) {
        $schedule=$this->dataSchedule($schedule);
        return response()->json(['code' => 200, 'status' => 'success', 'data' => $schedule], 200);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/schedules/{id}",
    *   tags={"Schedules"},
    *   summary="Update schedule",
    *   description="Update a single schedule",
    *   operationId="updateSchedule",
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
    *       name="start",
    *       in="query",
    *       description="Start time of schedule (H:i)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="end",
    *       in="query",
    *       description="End time of schedule (H:i)",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *   @OA\Parameter(
    *       name="days[]",
    *       in="query",
    *       description="Days of schedule (1=Monday, 2=Tuesday, 3=Wednesday, 4=Thursday, 5=Friday, 6=Saturday, 7=Sunday)",
    *       required=true,
    *       @OA\Schema(
    *           type="array",
    *           @OA\Items(type="integer")
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
    *       description="Update schedule.",
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
    public function update(ScheduleUpdateRequest $request, Schedule $schedule) {
        $schedules=Schedule::where([['id', '!=',$schedule->id], ['start', '>=', request('start')], ['start', '<=', request('end')], ['state', '1']])->orWhere([['id', '!=',$schedule->id], ['end', '>=', request('start')], ['end', '<=', request('end')], ['state', '1']])->orWhere([['id', '!=',$schedule->id], ['start', '<=', request('start')], ['end', '>=', request('end')], ['state', '1']])->orWhere([['id', '!=',$schedule->id], ['start', '>=', request('start')], ['end', '<=', request('end')], ['state', '1']])->get();
        foreach ($schedules as $data) {
            foreach ($data->days as $day) {
                foreach (request('days') as $selected) {
                    if ($day==$selected) {
                        return response()->json(['code' => 422, 'status' => 'error', 'message' => trans('api.errors.422.schedule')], 422);
                    }
                }
            }
        }

        $data=array('start' => request('start'), 'end' => request('end'), 'days' => request('days'));
        $schedule->fill($data)->save();
        if ($schedule) {
            $schedule=Schedule::where('id', $schedule->id)->first();
            $schedule=$this->dataSchedule($schedule);
            return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.schedules.update'), 'data' => $schedule], 200);
        }
        
        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Delete(
    *   path="/api/v1/schedules/{id}",
    *   tags={"Schedules"},
    *   summary="Delete schedule",
    *   description="Delete a single schedule",
    *   operationId="destroySchedule",
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
    *       description="Delete schedule.",
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
    public function destroy(Schedule $schedule)
    {
    	$schedule->delete();
    	if ($schedule) {
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.schedules.destroy')], 200);
    	}

    	return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/schedules/{id}/deactivate",
    *   tags={"Schedules"},
    *   summary="Deactivate schedule",
    *   description="Deactivate a single schedule",
    *   operationId="deactivateSchedule",
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
    *       description="Deactivate schedule.",
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
    public function deactivate(Request $request, Schedule $schedule) {
    	$schedule->fill(['state' => "0"])->save();
    	if ($schedule) {
            $schedule=$this->dataSchedule($schedule);
            return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.schedules.deactivate'), 'data' => $schedule], 200);
        }

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }

    /**
    *
    * @OA\Put(
    *   path="/api/v1/schedules/{id}/activate",
    *   tags={"Schedules"},
    *   summary="Activate schedule",
    *   description="Activate a single schedule",
    *   operationId="activateSchedule",
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
    *       description="Activate schedule.",
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
    public function activate(Request $request, Schedule $schedule) {
        $schedules=Schedule::where([['start', '>=', $schedule->start->format('H:i')], ['start', '<=', $schedule->end->format('H:i')], ['state', '1']])->orWhere([['end', '>=', $schedule->start->format('H:i')], ['end', '<=', $schedule->end->format('H:i')], ['state', '1']])->orWhere([['start', '<=', $schedule->start->format('H:i')], ['end', '>=', $schedule->end->format('H:i')], ['state', '1']])->orWhere([['start', '>=', $schedule->start->format('H:i')], ['end', '<=', $schedule->end->format('H:i')], ['state', '1']])->get();
        foreach ($schedules as $data) {
            foreach ($data->days as $day) {
                foreach ($schedule->days as $selected) {
                    if ($day==$selected) {
                        return response()->json(['code' => 422, 'status' => 'error', 'message' => trans('api.errors.422.schedule')], 422);
                    }
                }
            }
        }
        
    	$schedule->fill(['state' => "1"])->save();
    	if ($schedule) {
    		$schedule=$this->dataSchedule($schedule);
    		return response()->json(['code' => 200, 'status' => 'success', 'message' => trans('api.schedules.activate'), 'data' => $schedule], 200);
    	}

        return response()->json(['code' => 500, 'status' => 'error', 'message' => trans('api.errors.500')], 500);
    }
}
