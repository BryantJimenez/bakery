<?php

namespace App\Models\Cart;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    protected $table = 'cart_product';

    protected $fillable = ['code', 'price', 'complement_price', 'qty', 'subtotal', 'product_id', 'cart_id'];

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        $cart_product=$this->with(['product', 'complements.complement', 'complements.group.attribute'])->where($field, $value)->first();
        if (!is_null($cart_product)) {
            return $cart_product;
        }

        return abort(404);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function cart() {
        return $this->belongsTo(Cart::class);
    }

    public function complements() {
        return $this->hasMany(CartComplement::class);
    }
}
