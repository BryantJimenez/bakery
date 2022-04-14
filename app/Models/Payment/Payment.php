<?php

namespace App\Models\Payment;

use App\Models\User;
use App\Models\Currency;
use App\Models\Order\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['subject', 'subtotal', 'delivery', 'total', 'fee', 'balance', 'method', 'state', 'currency_id', 'user_id'];

    /**
     * Get the method.
     *
     * @return string
     */
    public function getMethodAttribute($value)
    {
        if ($value=='1') {
            return trans('admin.values_attributes.methods.card');
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
            return trans('admin.values_attributes.states.payments.pending');
        } elseif ($value=='1') {
            return trans('admin.values_attributes.states.payments.confirmed');
        } elseif ($value=='0') {
            return trans('admin.values_attributes.states.payments.rejected');
        }
        return trans('admin.values_attributes.unknown');
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function stripe() {
        return $this->hasOne(Stripe::class);
    }

    public function order() {
        return $this->hasOne(Order::class);
    }
}
