<?php

namespace App\Models\Order;

use App\Models\Complement;
use App\Models\Group\Group;
use Illuminate\Database\Eloquent\Model;

class ComplementOrder extends Model
{
    protected $table = 'complement_order';

    protected $fillable = ['qty', 'price', 'subtotal', 'complement_id', 'group_id', 'order_product_id'];

    public function order_product() {
        return $this->belongsTo(OrderProduct::class);
    }

    public function complement() {
        return $this->belongsTo(Complement::class);
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }
}
