<?php

namespace App\Jobs;

use App\Models\Setting;
use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StateStore implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $setting=Setting::where('id', 1)->firstOrFail();
        if ($setting->force==trans('admin.values_attributes.forces.no')) {
            $schedules=Schedule::where([['start', '<=', date('H:i')], ['end', '>=', date('H:i')], ['state', '1']])->get();
            if ($schedules->count()>0) {
                $setting->fill(['state' => '1'])->save();
            } else {
                $setting->fill(['state' => '0'])->save();
            }
        }
    }
}
