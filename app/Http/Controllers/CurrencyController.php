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
            return redirect()->route('currencies.index')->with(['alert' => 'lobibox', 'type' => 'warning', 'title' => 'La moneda ya existe', 'msg' => 'Esta moneda ya se encuentra registrada.']);
        } else {
            $data=array('name' => request('name'), 'iso' => request('iso'), 'symbol' => request('symbol'));
            $currency=Currency::create($data);
        }

        if ($currency) {
            return redirect()->route('currencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La moneda ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('currencies.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
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
            return redirect()->route('currencies.edit', ['currency' => $currency->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La moneda ha sido editada exitosamente.']);
        } else {
            return redirect()->route('currencies.edit', ['currency' => $currency->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
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
            return redirect()->route('currencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La moneda ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('currencies.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, Currency $currency) {
        $currency->fill(['state' => "0"])->save();
        if ($currency) {
            return redirect()->route('currencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La moneda ha sido desactivada exitosamente.']);
        } else {
            return redirect()->route('currencies.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, Currency $currency) {
        $currency->fill(['state' => "1"])->save();
        if ($currency) {
            return redirect()->route('currencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La moneda ha sido activada exitosamente.']);
        } else {
            return redirect()->route('currencies.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
