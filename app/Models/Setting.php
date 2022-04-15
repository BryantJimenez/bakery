<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
	use HasTranslations;

    protected $fillable = ['terms', 'privacity', 'stripe_public', 'stripe_secret', 'currency_id'];

    protected $casts = [ 
        'terms' => 'array',
        'privacity' => 'array'
    ];

    public $translatable = ['terms', 'privacity'];

    public function currency() {
        return $this->belongsTo(Currency::class);
    }
}
