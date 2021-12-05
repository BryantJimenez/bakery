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
        $trashed=Currency::where('slug', Str::slug(request('name')))->withTrashed()->exists();
        $exist=Currency::where('slug', Str::slug(request('name')))->exists();
        if ($trashed && $exist===false) {
            $currency=Currency::where('slug', Str::slug(request('name')))->withTrashed()->first();
            $currency->restore();
        } else if ($exist) {
            return redirect()->route('currencies.index')->with(['alert' => 'lobibox', 'type' => 'warning', 'title' => 'It already exists', 'msg' => 'This currency already exists.']);
        } else {
            $data=array('name' => request('name'), 'iso' => request('iso'), 'symbol' => request('symbol'));
            $currency=Currency::create($data);
        }

        if ($currency) {
            return redirect()->route('currencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful registration', 'msg' => 'The currency has been successfully registered.']);
        } else {
            return redirect()->route('currencies.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed registration', 'msg' => 'An error occurred during the process, please try again.'])->withInputs();
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
            return redirect()->route('currencies.edit', ['currency' => $currency->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful editing', 'msg' => 'The currency has been edited successfully.']);
        } else {
            return redirect()->route('currencies.edit', ['currency' => $currency->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred during the process, please try again.']);
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
            return redirect()->route('currencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful removal', 'msg' => 'The currency has been successfully removed.']);
        } else {
            return redirect()->route('currencies.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed deletion', 'msg' => 'An error occurred during the process, please try again.']);
        }
    }

    public function deactivate(Request $request, Currency $currency) {
        $currency->fill(['state' => "0"])->save();
        if ($currency) {
            return redirect()->route('currencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful editing', 'msg' => 'The currency has been successfully deactivated.']);
        } else {
            return redirect()->route('currencies.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred during the process, please try again.']);
        }
    }

    public function activate(Request $request, Currency $currency) {
        $currency->fill(['state' => "1"])->save();
        if ($currency) {
            return redirect()->route('currencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful editing', 'msg' => 'The currency has been activated successfully.']);
        } else {
            return redirect()->route('currencies.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred during the process, please try again.']);
        }
    }
}
