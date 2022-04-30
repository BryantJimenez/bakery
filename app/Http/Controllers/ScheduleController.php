<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Http\Requests\Schedule\ScheduleStoreRequest;
use App\Http\Requests\Schedule\ScheduleUpdateRequest;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $schedules=Schedule::orderBy('id', 'DESC')->get();
        return view('admin.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleStoreRequest $request) {
        $schedules=Schedule::where([['start', '>=', request('start')], ['start', '<=', request('end')], ['state', '1']])->orWhere([['end', '>=', request('start')], ['end', '<=', request('end')], ['state', '1']])->orWhere([['start', '<=', request('start')], ['end', '>=', request('end')], ['state', '1']])->orWhere([['start', '>=', request('start')], ['end', '<=', request('end')], ['state', '1']])->get();
        foreach ($schedules as $schedule) {
            foreach ($schedule->days as $day) {
                foreach (request('days') as $selected) {
                    if ($day==$selected) {
                        return redirect()->route('schedules.create')->with(['alert' => 'lobibox', 'type' => 'warning', 'title' => trans('admin.notifications.error.messages.schedules.422.title'), 'msg' => trans('admin.notifications.error.messages.schedules.422.msg')]);
                    }
                }
            }
        }

        $data=array('start' => request('start'), 'end' => request('end'), 'days' => request('days'));
        $schedule=Schedule::create($data);

        if ($schedule) {
            return redirect()->route('schedules.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.store'), 'msg' => trans('admin.notifications.success.messages.schedules.store')]);
        } else {
            return redirect()->route('schedules.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.store'), 'msg' => trans('admin.notifications.error.500')])->withInputs();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule) {
        return view('admin.schedules.edit', compact("schedule"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleUpdateRequest $request, Schedule $schedule) {
        $schedules=Schedule::where([['id', '!=',$schedule->id], ['start', '>=', request('start')], ['start', '<=', request('end')], ['state', '1']])->orWhere([['id', '!=',$schedule->id], ['end', '>=', request('start')], ['end', '<=', request('end')], ['state', '1']])->orWhere([['id', '!=',$schedule->id], ['start', '<=', request('start')], ['end', '>=', request('end')], ['state', '1']])->orWhere([['id', '!=',$schedule->id], ['start', '>=', request('start')], ['end', '<=', request('end')], ['state', '1']])->get();
        foreach ($schedules as $data) {
            foreach ($data->days as $day) {
                foreach (request('days') as $selected) {
                    if ($day==$selected) {
                        return redirect()->route('schedules.edit', ['schedule' => $schedule->id])->with(['alert' => 'lobibox', 'type' => 'warning', 'title' => trans('admin.notifications.error.messages.schedules.422.title'), 'msg' => trans('admin.notifications.error.messages.schedules.422.msg')]);
                    }
                }
            }
        }

        $data=array('start' => request('start'), 'end' => request('end'), 'days' => request('days'));
        $schedule->fill($data)->save();
        if ($schedule) {
            return redirect()->route('schedules.edit', ['schedule' => $schedule->id])->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.schedules.update')]);
        } else {
            return redirect()->route('schedules.edit', ['schedule' => $schedule->id])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule) {
        $schedule->delete();
        if ($schedule) {
            return redirect()->route('schedules.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.destroy'), 'msg' => trans('admin.notifications.success.messages.schedules.destroy')]);
        } else {
            return redirect()->route('schedules.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.destroy'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    public function deactivate(Request $request, Schedule $schedule) {
        $schedule->fill(['state' => "0"])->save();
        if ($schedule) {
            return redirect()->route('schedules.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.schedules.deactivate')]);
        } else {
            return redirect()->route('schedules.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    public function activate(Request $request, Schedule $schedule) {
        $schedules=Schedule::where([['start', '>=', $schedule->start->format('H:i')], ['start', '<=', $schedule->end->format('H:i')], ['state', '1']])->orWhere([['end', '>=', $schedule->start->format('H:i')], ['end', '<=', $schedule->end->format('H:i')], ['state', '1']])->orWhere([['start', '<=', $schedule->start->format('H:i')], ['end', '>=', $schedule->end->format('H:i')], ['state', '1']])->orWhere([['start', '>=', $schedule->start->format('H:i')], ['end', '<=', $schedule->end->format('H:i')], ['state', '1']])->get();
        foreach ($schedules as $data) {
            foreach ($data->days as $day) {
                foreach ($schedule->days as $selected) {
                    if ($day==$selected) {
                        return redirect()->route('schedules.index')->with(['alert' => 'lobibox', 'type' => 'warning', 'title' => trans('admin.notifications.error.messages.schedules.422.title'), 'msg' => trans('admin.notifications.error.messages.schedules.422.msg')]);
                    }
                }
            }
        }

        $schedule->fill(['state' => "1"])->save();
        if ($schedule) {
            return redirect()->route('schedules.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.schedules.activate')]);
        } else {
            return redirect()->route('schedules.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }
}
