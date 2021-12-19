<?php

namespace App\Models\Order;

use App\Models\Agency;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = ['address', 'agency_id', 'order_id'];

    public function agency() {
	  	return $this->belongsTo(Agency::class);
	}

	public function order() {
	  	return $this->belongsTo(Order::class);
	}
}
