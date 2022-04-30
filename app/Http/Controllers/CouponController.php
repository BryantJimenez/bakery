<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Http\Requests\Coupon\CouponStoreRequest;
use App\Http\Requests\Coupon\CouponUpdateRequest;
use Illuminate\Http\Request;
use Str;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $coupons=Coupon::orderBy('id', 'DESC')->get();
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponStoreRequest $request) {
        while (true) {
            $code=Str::random(8);
            $count=Coupon::where('slug', Str::slug($code, '-'))->withTrashed()->count();
            if ($count==0) {
                break;
            }
        }

        $data=array('code' => $code, 'discount' => request('discount'), 'limit' => request('limit'), 'type' => request('type'));
        $coupon=Coupon::create($data);
        if ($coupon) {
            return redirect()->route('coupons.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.store'), 'msg' => trans('admin.notifications.success.messages.coupons.store')]);
        } else {
            return redirect()->route('coupons.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.store'), 'msg' => trans('admin.notifications.error.500')])->withInputs();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon) {
        return view('admin.coupons.edit', compact("coupon"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponUpdateRequest $request, Coupon $coupon) {
        $data=array('discount' => request('discount'), 'limit' => request('limit'), 'type' => request('type'));
        $coupon->fill($data)->save();
        if ($coupon) {
            return redirect()->route('coupons.edit', ['coupon' => $coupon->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.coupons.update')]);
        } else {
            return redirect()->route('coupons.edit', ['coupon' => $coupon->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon) {
        $coupon->delete();
        if ($coupon) {
            return redirect()->route('coupons.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.destroy'), 'msg' => trans('admin.notifications.success.messages.coupons.destroy')]);
        } else {
            return redirect()->route('coupons.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.destroy'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    public function deactivate(Request $request, Coupon $coupon) {
        $coupon->fill(['state' => "0"])->save();
        if ($coupon) {
            return redirect()->route('coupons.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.coupons.deactivate')]);
        } else {
            return redirect()->route('coupons.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    public function activate(Request $request, Coupon $coupon) {
        $coupon->fill(['state' => "1"])->save();
        if ($coupon) {
            return redirect()->route('coupons.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.coupons.activate')]);
        } else {
            return redirect()->route('coupons.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }
}
