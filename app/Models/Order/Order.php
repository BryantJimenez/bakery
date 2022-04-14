<?php

namespace App\Models\Order;

use App\Models\User;
use App\Models\Currency;
use App\Models\Payment\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes;

    protected $fillable = ['subtotal', 'delivery', 'total', 'fee', 'balance', 'type_delivery', 'phone', 'state', 'user_id', 'currency_id', 'payment_id'];

    /**
     * Get the type delivery.
     *
     * @return string
     */
    public function getTypeDeliveryAttribute($value)
    {
        if ($value=='3') {
            trans('admin.values_attributes.types_delivery.orders.delivery');
        } elseif ($value=='2') {
            trans('admin.values_attributes.types_delivery.orders.to take away');
        } elseif ($value=='1') {
            trans('admin.values_attributes.types_delivery.orders.eat on site');
        }
        return trans('admin.values_attributes.unknown');
    }

    /**
     * Get the state.
     *
     * @return string
     */
    public function getStateAttribute($value)
    {
        if ($value=='2') {
            return trans('admin.values_attributes.states.orders.waiting');
        } elseif ($value=='1') {
            return trans('admin.values_attributes.states.orders.confirmed');
        } elseif ($value=='0') {
            return trans('admin.values_attributes.states.orders.rejected');
        }
        return trans('admin.values_attributes.unknown');
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        $order=$this->with(['user' => function($query) {
            $query->withTrashed();
        }, 'currency' => function($query) {
            $query->withTrashed();
        }, 'payment' => function($query) {
            $query->withTrashed();
        }, 'shipping' => function($query) {
            $query->withTrashed();
        }, 'shipping.agency' => function($query) {
            $query->withTrashed();
        }, 'order_products.product' => function($query) {
            $query->withTrashed();
        }, 'order_products.product.category' => function($query) {
            $query->withTrashed();
        }, 'order_products.complements.complement' => function($query) {
            $query->withTrashed();
        }, 'order_products.complements.group' => function($query) {
            $query->withTrashed();
        }, 'order_products.complements.group.attribute' => function($query) {
            $query->withTrashed();
        }])->where($field, $value)->first();
        if (!is_null($order)) {
            return $order;
        }

        return abort(404);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function payment() {
        return $this->belongsTo(Payment::class);
    }

    public function order_products() {
        return $this->hasMany(OrderProduct::class);
    }

    public function shipping() {
        return $this->hasOne(Shipping::class);
    }
}
