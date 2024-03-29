<?php

namespace App\Models;

use App\Models\Payment\Payment;
use App\Models\Order\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Currency extends Model
{
    use SoftDeletes, HasSlug, HasTranslations;

    protected $fillable = ['name', 'slug', 'iso', 'symbol', 'state'];

    protected $casts = [ 
        'name' => 'array'
    ];

    /**
     * Get the state.
     *
     * @return string
     */
    public function getStateAttribute($value)
    {
        if ($value=='1') {
            return trans('admin.values_attributes.states.active');
        } elseif ($value=='0') {
            return trans('admin.values_attributes.states.inactive');
        }
        return trans('admin.values_attributes.unknown');
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        $currency=$this->where($field, $value)->first();
        if (!is_null($currency)) {
            return $currency;
        }

        return abort(404);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug')->slugsShouldBeNoLongerThan(191)->doNotGenerateSlugsOnUpdate();
    }

    public $translatable = ['name'];

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function setting() {
        return $this->hasOne(Setting::class);
    }
}
