<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\Setting\SettingUpdateRequest;

class SettingController extends Controller
{
    public function edit() {
        $setting=Setting::where('id', 1)->firstOrFail();
        $currencies=Currency::where('state', '1')->get();
        return view('admin.settings.edit', compact("setting", "currencies"));
    }

    public function update(SettingUpdateRequest $request) {
        $setting=Setting::where('id', 1)->firstOrFail();
        $currency=Currency::where('slug', request('currency_id'))->first();
        $force=(request('state')=='1') ? '1' : '0';
        $data=array('terms' => request('terms'), 'privacity' => request('privacity'), 'stripe_public' => request('stripe_public'), 'stripe_secret' => request('stripe_secret'), 'force' => $force, 'state' => request('state'), 'currency_id' => $currency->id);
        $setting->fill($data)->save();

        if ($setting) {
            return redirect()->route('settings.edit')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.settings.update')]);
        } else {
            return redirect()->route('settings.edit')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }
}
