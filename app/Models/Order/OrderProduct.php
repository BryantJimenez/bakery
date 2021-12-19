<?php

namespace App\Models\Order;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
	protected $table = 'order_product';

    protected $fillable = ['qty', 'price', 'complement_price', 'subtotal', 'product_id', 'order_id'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function complements() {
        return $this->hasMany(ComplementOrder::class);
    }
}
