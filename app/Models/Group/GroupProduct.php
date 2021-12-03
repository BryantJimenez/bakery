<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Model;

class GroupProduct extends Model
{
    protected $table = 'group_product';

    protected $fillable = ['group_id', 'product_id'];
}
