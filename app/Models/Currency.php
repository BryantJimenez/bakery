<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Currency extends Model
{
    use SoftDeletes, HasSlug;

    protected $fillable = ['name', 'slug', 'iso', 'symbol', 'state'];

    /**
     * Get the state.
     *
     * @return string
     */
    public function getStateAttribute($value)
    {
        if ($value=='1') {
            return 'Activo';
        } elseif ($value=='0') {
            return 'Inactivo';
        }
        return 'Desconocido';
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

    public function setting() {
        return $this->hasOne(Setting::class);
    }
}
