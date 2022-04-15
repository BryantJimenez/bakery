<?php

namespace App\Models;

use App\Models\Order\Shipping;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Agency extends Model
{
    use SoftDeletes, HasSlug, HasTranslations;

    protected $fillable = ['name', 'slug', 'route', 'description', 'price', 'state'];

    protected $casts = [ 
        'name' => 'array',
        'route' => 'array',
        'description' => 'array'
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
        $agency=$this->where($field, $value)->first();
        if (!is_null($agency)) {
            return $agency;
        }

        return abort(404);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug')->slugsShouldBeNoLongerThan(191)->doNotGenerateSlugsOnUpdate();
    }

    public $translatable = ['name', 'route', 'description'];

    public function shippings() {
        return $this->hasMany(Shipping::class);
    }
}
