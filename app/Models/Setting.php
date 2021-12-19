<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['terms', 'privacity', 'stripe_public', 'stripe_secret', 'currency_id'];

    public function currency() {
        return $this->belongsTo(Currency::class);
    }
}
