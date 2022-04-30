<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
	use HasTranslations;

    protected $fillable = ['terms', 'privacity', 'stripe_public', 'stripe_secret', 'force', 'state', 'currency_id'];

    protected $casts = [ 
        'terms' => 'array',
        'privacity' => 'array'
    ];

    /**
     * Get the force.
     *
     * @return string
     */
    public function getForceAttribute($value)
    {
        if ($value=='1') {
            return trans('admin.values_attributes.forces.yes');
        } elseif ($value=='0') {
            return trans('admin.values_attributes.forces.no');
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
        if ($value=='1') {
            return trans('admin.values_attributes.states.settings.open');
        } elseif ($value=='0') {
            return trans('admin.values_attributes.states.settings.closed');
        }
        return trans('admin.values_attributes.unknown');
    }

    public $translatable = ['terms', 'privacity'];

    public function currency() {
        return $this->belongsTo(Currency::class);
    }
}
