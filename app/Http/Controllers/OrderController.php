<?php
 
namespace App\Http\Controllers;

use App\Models\Order\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $orders=Order::with(['user' => function($query) {
            $query->withTrashed();
        }, 'currency' => function($query) {
            $query->withTrashed();
        }])->orderBy('id', 'DESC')->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order) {
        return view('admin.orders.show', compact('order'));
    }

    public function reject(Request $request, Order $order) {
        $order->fill(['state' => "0"])->save();
        if ($order) {
            return redirect()->route('orders.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.orders.reject')]);
        } else {
            return redirect()->route('orders.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }

    public function confirm(Request $request, Order $order) {
        $order->fill(['state' => "1"])->save();
        if ($order) {
            return redirect()->route('orders.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.orders.confirm')]);
        } else {
            return redirect()->route('orders.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500')]);
        }
    }
}
