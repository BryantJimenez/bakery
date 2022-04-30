<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agency;
use App\Models\Coupon;
use App\Models\Setting;
use App\Models\Product;
use App\Models\Category;
use App\Models\Schedule;
use App\Models\Order\Order;
use App\Models\Payment\Stripe;
use App\Models\Order\Shipping;
use App\Models\Payment\Payment;
use JoeDixon\Translation\Language;
use App\Models\Order\OrderProduct;
use App\Models\Order\ComplementOrder;
use App\Http\Requests\Checkout\CouponAddRequest;
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

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $language='es';
                if (!is_null(Auth::user()->language)) {
                    $language=Auth::user()->language->language;
                }
                app()->setLocale($language);

                if (session()->has('locale') && !is_null(session('locale'))) {
                    if ($language!=session('locale')) {
                        session()->put('locale', $language);
                    }
                } else {
                    session()->push('locale', $language);
                }
            }

            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $schedules=Schedule::where('state', '1')->get();
        return view('web.home', compact('schedules'));
    }

    public function offline() {
        return view('vendor.laravelpwa.offline');
    }

    public function shop() {
        return view('web.shop');
    }

    public function checkout() {
        $setting=Setting::firstOrFail();
        $agencies=Agency::where('state', '1')->get();
        return view('web.checkout', compact('setting', 'agencies'));
    }

    public function couponAdd(CouponAddRequest $request) {
        $coupon=Coupon::where('code', request('coupon'))->first();
        if (!is_null($coupon)) {
            if (Auth::check()) {
                $user=Auth::user();
                $email=Auth::user()->email;
            } else {
                $user=User::where('email', request('email'))->first();
                $email=request('email');
            }
            if (is_null($user) || $coupon->orders->where('user_id', $user->id)->count()==0) {
                if ($coupon->limit>$coupon->use && $coupon->state==trans('admin.values_attributes.states.active')) {
                    if (!session()->has('coupon')) {
                        $request->session()->put('coupon', ['coupon' => $coupon, 'email' => $email]);
                        return response()->json(["state" => true, "coupon" => $coupon->slug]);
                    }

                    return response()->json(["state" => false, "title" => trans('web.notifications.error.titles.coupons.limit'), "message" => trans('web.notifications.error.messages.coupons.limit')]);
                }

                return response()->json(["state" => false, "title" => trans('web.notifications.error.titles.coupons.expired'), "message" => trans('web.notifications.error.messages.coupons.expired')]);
            }

            return response()->json(["state" => false, "title" => trans('web.notifications.error.titles.coupons.not available'), "message" => trans('web.notifications.error.messages.coupons.not available')]);
        }

        return response()->json(["state" => false, "title" => trans('web.notifications.error.titles.coupons.error'), "message" => trans('web.notifications.error.messages.coupons.error')]);
    }

    public function couponRemove(Request $request) {
        $request->session()->forget('coupon');
        return response()->json(["state" => true]);
    }

    public function checkoutStore(CheckoutBuyRequest $request) {
        $setting=Setting::with(['currency'])->firstOrFail();
        if ($setting->state==trans('admin.values_attributes.states.settings.closed')) {
            return redirect()->back()->with(['type' => 'error', 'title' => trans('web.notifications.error.titles.closed'), 'msg' => trans('web.notifications.error.messages.closed')]);
        }

        if (is_null($setting['currency'])) {
            return redirect()->back()->with(['type' => 'error', 'title' => trans('web.notifications.error.titles.buy'), 'msg' => trans('admin.notifications.error.500')]);
        }

        $counter=$this->counterCart();
        if ($counter==0) {
            return redirect()->back()->with(['type' => 'warning', 'title' => trans('web.notifications.error.titles.cart'), 'msg' => trans('web.notifications.error.messages.cart')]);
        }

        $subject=trans('web.notifications.error.messages.subject.buy');
        $subtotal=$this->calculateCart();
        $delivery=0.00;
        $discount=0.00;
        if (request('shipping')=='3') {
            $agency=Agency::where('slug', request('agency_id'))->first();
            if (!is_null($agency)) {
                $delivery=$agency->price;
            }
        }
        if (session()->has('coupon')) {
            $coupon=Coupon::where([['slug', session('coupon')['coupon']->slug], ['state', '1']])->first();
            if (!is_null($coupon)) {
                if ($coupon->limit<=$coupon->use) {
                    $request->session()->forget('coupon');
                    return redirect()->back()->with(['type' => 'warning', 'title' => trans('web.notifications.error.titles.coupons.expired'), 'msg' => trans('web.notifications.error.messages.coupons.expired')]);
                }

                if ($coupon->type==trans('admin.values_attributes.types.coupons.percentage')) {
                    $discount=(($subtotal+$delivery)*$coupon->discount)/100;
                } elseif ($coupon->type==trans('admin.values_attributes.types.coupons.fixed')) {
                    $discount=$coupon->discount;
                }
            } else {
                $request->session()->forget('coupon');
                return redirect()->back()->with(['type' => 'warning', 'title' => trans('web.notifications.error.titles.coupons.expired'), 'msg' => trans('web.notifications.error.messages.coupons.expired')]);
            }
        }
        $total=$subtotal+$delivery-$discount;

        $result=$this->payWithStripe(number_format($total, 2, '.', ''), strtolower($setting['currency']->iso), $subject, request('stripeToken'));
        if ($result['status']=='error') {
            return redirect()->back()->with(['type' => 'error', 'title' => trans('web.notifications.error.titles.buy'), 'msg' => trans('admin.notifications.error.500')]);
        }

        $fee=$this->stripeFee($result['data']['balance_transaction']);
        $balance=$total-$fee;

        $data=array('subject' => $subject, 'subtotal' => $subtotal, 'delivery' => $delivery, 'discount' => $discount, 'total' => $total, 'fee' => $fee, 'balance' => $balance, 'method' => '1', 'state' => '1', 'currency_id' => $setting->currency_id, 'user_id' => Auth::id());
        if (session()->has('coupon')) {
            $data['coupon_id']=session('coupon')['coupon']->id;
        }
        $payment=Payment::create($data);

        if ($payment) {
            $data=array('stripe_payment_id' => $result['data']['charge']->id, 'balance_transaction' => $result['data']['charge']->balance_transaction, 'payment_id' => $payment->id);
            Stripe::create($data);

            $data=array('subtotal' => $subtotal, 'delivery' => $delivery, 'discount' => $discount, 'total' => $total, 'fee' => $fee, 'balance' => $balance, 'type_delivery' => request('shipping'), 'phone' => request('phone'), 'state' => '2', 'user_id' => Auth::id(), 'currency_id' => $setting->currency_id, 'payment_id' => $payment->id);
            if (session()->has('coupon')) {
                $data['coupon_id']=session('coupon')['coupon']->id;
            }
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
                    $agency=Agency::where('slug', request('agency_id'))->first();
                    if (!is_null($agency)) {
                        $data=array('address' => request('address'), 'agency_id' => $agency->id, 'order_id' => $order->id);
                        Shipping::create($data);
                    }
                }

                $user=User::where('slug', Auth::user()->slug)->first();
                if (!is_null($user)) {
                    $points=round($user->points+(($total*10)/100), 0);
                    $data=['points' => $points];
                    if (is_null($user->phone)) {
                        $data['phone']=request('phone');
                    }
                    if (is_null($user->address)) {
                        $data['address']=request('address');
                    }

                    $user->fill($data)->save();
                    if ($user) {
                        Auth::user()->points=$points;
                        if (isset($data['phone'])) {
                            Auth::user()->phone=request('phone');
                        }
                        if (isset($data['address'])) {
                            Auth::user()->address=request('address');
                        }
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
        $languages=Language::all();
        $orders=Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        return view('web.profile.profile', compact('setting', 'orders', 'languages'));
    }

    public function profileUpdate(ProfileUpdateRequest $request) {
        $user=User::where('id', Auth::id())->firstOrFail();
        $data=array('name' => request('name'), 'lastname' => request('lastname'), 'address' => request('address'), 'phone' => request('phone'), 'language_id' => request('language_id'));

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
            Auth::user()->language_id=request('language_id');
            if (!is_null(request('password'))) {
                Auth::user()->password=Hash::make(request('password'));
            }
            return redirect()->route('web.profile')->with(['type' => 'success', 'title' => trans('admin.notifications.success.titles.update'), 'msg' => trans('admin.notifications.success.messages.profile.update'), 'tabs' => 'setting']);
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