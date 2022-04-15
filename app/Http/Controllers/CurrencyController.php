<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Http\Requests\Currency\CurrencyStoreRequest;
use App\Http\Requests\Currency\CurrencyUpdateRequest;
use Illuminate\Http\Request;
use Str;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $currencies=Currency::orderBy('id', 'DESC')->get();
        return view('admin.currencies.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyStoreRequest $request) {
        $trashed=Currency::where('slug', Str::slug(request('name')['es']))->withTrashed()->exists();
        $exist=Currency::where('slug', Str::slug(request('name')['es']))->exists();
        if ($trashed && $exist===false) {
            $currency=Currency::where('slug', Str::slug(request('name')['es']))->withTrashed()->first();
            $currency->restore();
        } else if ($exist) {
            return redirect()->route('currencies.index')->with(['alert' => 'lobibox', 'type' => 'warning', 'title' => trans('admin.notifications.error.messages.currencies.422.title'), 'msg' => trans('admin.notifications.error.messages.currencies.422.msg')]);
        } else {
            $data=array('name' => request('name'), 'iso' => request('iso'), 'symbol' => request('symbol'));
            $currency=Currency::create($data);
        }

        if ($currency) {
            return redirect()->route('currencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.store'), 'msg' => trans('admin.notifications.success.messages.currencies.store')]);
        } else {
            return redirect()->route('currencies.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.store'), 'msg' => trans('admin.notifications.error.500')])->withInputs();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency) {
        return view('admin.currencies.edit', compact("currency"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyUpdateRequest $request, Currency $currency) {
        $data=array('name' => request('name'), 'iso' => request('iso'), 'symbol' => request('symbol'));
        $currency->fill($data)->save();
        if ($currency) {
            return redirect()->route('currencies.edit', ['currency' => $currency->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.currencies.update')]);
        } else {
            return redirect()->route('currencies.edit', ['currency' => $currency->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency) {
        $currency->delete();
        if ($currency) {
            return redirect()->route('currencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.destroy'), 'msg' => trans('admin.notifications.success.messages.currencies.destroy')]);
        } else {
            return redirect()->route('currencies.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.destroy'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    public function deactivate(Request $request, Currency $currency) {
        $currency->fill(['state' => "0"])->save();
        if ($currency) {
            return redirect()->route('currencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.currencies.deactivate')]);
        } else {
            return redirect()->route('currencies.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    public function activate(Request $request, Currency $currency) {
        $currency->fill(['state' => "1"])->save();
        if ($currency) {
            return redirect()->route('currencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.currencies.activate')]);
        } else {
            return redirect()->route('currencies.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }
}
