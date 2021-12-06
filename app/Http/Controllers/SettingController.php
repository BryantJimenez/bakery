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
        $data=array('terms' => request('terms'), 'privacity' => request('privacity'), 'currency_id' => $currency->id);
        $setting->fill($data)->save();

        if ($setting) {
            return redirect()->route('settings.edit')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'Los ajustes han sido editados exitosamente.']);
        } else {
            return redirect()->route('settings.edit')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
