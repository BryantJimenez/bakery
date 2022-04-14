<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agency;
use App\Models\Setting;
use App\Models\Payment\Payment;
use App\Models\Payment\Stripe;
use App\Models\Order\Order;
use App\Models\Order\OrderProduct;
use App\Models\Order\ComplementOrder;
use App\Models\Order\Shipping;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Http\Requests\Checkout\CheckoutBuyRequest;
use Illuminate\Http\Request;
use App\Traits\CartTrait;
use App\Traits\StripeTrait;
use Exception;
use Auth;

class WebController extends Controller
{
    use CartTrait, StripeTrait;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('web.home');
    }

    public function checkout() {
        $setting=Setting::firstOrFail();
        $agencies=Agency::where('state', '1')->get();
        return view('web.checkout', compact('setting', 'agencies'));
    }

    public function checkoutStore(CheckoutBuyRequest $request) {
        $setting=Setting::with(['currency'])->firstOrFail();
        if (is_null($setting['currency'])) {
            return redirect()->back()->with(['type' => 'error', 'title' => trans('web.notifications.error.titles.buy'), 'msg' => trans('admin.notifications.error.500')]);
        }

        $counter=$this->counterCart();
        if ($counter==0) {
            return redirect()->back()->with(['type' => 'warning', 'title' => trans('web.notifications.error.titles.cart'), 'msg' => trans('web.notifications.error.messages.cart')]);
        }

        $subject='Compra de productos.';
        $subtotal=$this->calculateCart();
        $delivery=0.00;
        if (request('shipping')=='3') {
            $agency=Agency::where('slug', request('agency_id'))->firstOrFail();
            $delivery=$agency->price;
        }
        $total=$subtotal+$delivery;

        $result=$this->stripePayment($request, $total, $subject, strtolower($setting['currency']->iso));
        if ($result['status']=='error') {
            return redirect()->back()->with(['type' => 'error', 'title' => trans('web.notifications.error.titles.buy'), 'msg' => trans('admin.notifications.error.500')]);
        }

        $fee=$this->stripeFee($result['data']['balance_transaction']);
        $balance=$total-$fee;

        $data=array('subject' => $subject, 'subtotal' => $subtotal, 'delivery' => $delivery, 'total' => $total, 'fee' => $fee, 'balance' => $balance, 'method' => '1', 'state' => '1', 'currency_id' => $setting->currency_id, 'user_id' => Auth::id());
        $payment=Payment::create($data);

        if ($payment) {
            $data=array('stripe_payment_id' => $result['data']['charge']->id, 'balance_transaction' => $result['data']['charge']->balance_transaction, 'payment_id' => $payment->id);
            Stripe::create($data);

            $data=array('subtotal' => $subtotal, 'delivery' => $delivery, 'total' => $total, 'fee' => $fee, 'balance' => $balance, 'type_delivery' => request('shipping'), 'phone' => request('phone'), 'state' => '2', 'user_id' => Auth::id(), 'currency_id' => $setting->currency_id, 'payment_id' => $payment->id);
            $order=Order::create($data);

            if($order) {
                $cart=$this->getCartDatabase();
                foreach ($cart as $item) {
                    $subtotal=($item['price']+$item['complement_price'])*$item['qty'];
                    $data=array('qty' => $item['qty'], 'price' => $item['price'], 'complement_price' => $item['complement_price'], 'subtotal' => $subtotal, 'product_id' => $item['product']->id, 'order_id' => $order->id);
                    $order_product=OrderProduct::create($data);
                    if ($order_product) {
                        foreach ($item['complements'] as $complement) {
                            $data=array('qty' => $complement->qty, 'price' => $complement->price, 'subtotal' => $complement->subtotal, 'complement_id' => $complement->complement_id, 'group_id' => $complement->group_id, 'order_product_id' => $order_product->id);
                            ComplementOrder::create($data)->save();
                        }
                    }
                }
                
                if (request('shipping')=='3') {
                    $agency=Agency::where('slug', request('agency_id'))->firstOrFail();
                    $data=array('address' => request('address'), 'agency_id' => $agency->id, 'order_id' => $order->id);
                    Shipping::create($data);
                }

                $user=User::where('slug', Auth::user()->slug)->firstOrFail();
                $data=[];
                if (is_null($user->phone)) {
                    $data['phone']=request('phone');
                }
                if (is_null($user->address)) {
                    $data['address']=request('address');
                }

                $user->fill($data)->save();
                if ($user) {
                    if (isset($data['phone'])) {
                        Auth::user()->phone=request('phone');
                    }
                    if (isset($data['address'])) {
                        Auth::user()->address=request('address');
                    }
                }

                $this->clearCart();
                return redirect()->route('web.profile')->with(['type' => 'success', 'title' => trans('web.notifications.success.titles.buy'), 'msg' => trans('web.notifications.success.messages.buy')]);
            }
        }

        return redirect()->back()->with(['type' => 'error', 'title' => trans('web.notifications.error.titles.buy'), 'msg' => trans('admin.notifications.error.500')]);
    }

    public function profile() {
        $setting=Setting::firstOrFail();
        $orders=Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        return view('web.profile.profile', compact('setting', 'orders'));
    }

    public function profileUpdate(ProfileUpdateRequest $request) {
        $user=User::where('id', Auth::id())->firstOrFail();
        $data=array('name' => request('name'), 'lastname' => request('lastname'), 'address' => request('address'), 'phone' => request('phone'));

        if (!is_null(request('password'))) {
            $data['password']=Hash::make(request('password'));
        }

        // Mover imagen a carpeta users y extraer nombre
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $data['photo']=store_files($file, $slug, '/admins/img/users/');
        }

        $user->fill($data)->save();

        if ($user) {
            if ($request->hasFile('photo')) {
                Auth::user()->photo=$data['photo'];
            }
            Auth::user()->name=request('name');
            Auth::user()->lastname=request('lastname');
            Auth::user()->address=request('address');
            Auth::user()->phone=request('phone');
            if (!is_null(request('password'))) {
                Auth::user()->password=Hash::make(request('password'));
            }
            return redirect()->back()->with(['type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.profile.update'), 'tabs' => 'setting']);
        } else {
            return redirect()->back()->with(['type' => 'error', 'title' => trans('admin.notifications.error.titles.update'), 'msg' => trans('admin.notifications.error.500'), 'tabs' => 'setting'])->withInputs();
        }
    }

    public function profileOrder(Order $order) {
        if ($order->user_id!=Auth::id()) {
            abort(403);
        }

        $setting=Setting::firstOrFail();
        return view('web.profile.order', compact('setting', 'order'));
    }
}