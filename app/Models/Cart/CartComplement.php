<?php

namespace App\Models\Cart;

use App\Models\Complement;
use App\Models\Group\Group;
use Illuminate\Database\Eloquent\Model;

class CartComplement extends Model
{
    protected $table = 'cart_complement';

    protected $fillable = ['price', 'qty', 'subtotal', 'complement_id', 'group_id', 'cart_product_id'];

    public function cart_product() {
        return $this->belongsTo(CartProduct::class);
    }

    public function complement() {
        return $this->belongsTo(Complement::class);
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }
}
