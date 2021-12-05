<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['terms', 'privacity', 'currency_id'];

    public function currency() {
        return $this->belongsTo(Currency::class);
    }
}
