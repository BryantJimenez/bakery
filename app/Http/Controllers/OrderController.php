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
            return redirect()->route('orders.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El pedido ha sido rechazado exitosamente.']);
        } else {
            return redirect()->route('orders.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function confirm(Request $request, Order $order) {
        $order->fill(['state' => "1"])->save();
        if ($order) {
            return redirect()->route('orders.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El pedido ha sido confirmado exitosamente.']);
        } else {
            return redirect()->route('orders.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
