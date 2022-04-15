<?php

namespace App\Models;

use App\Models\Group\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Attribute extends Model
{
    use SoftDeletes, HasSlug, HasTranslations;

    protected $fillable = ['name', 'slug', 'state'];

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
        $attribute=$this->where($field, $value)->first();
        if (!is_null($attribute)) {
            return $attribute;
        }

        return abort(404);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug')->slugsShouldBeNoLongerThan(191)->doNotGenerateSlugsOnUpdate();
    }

    public $translatable = ['name'];

    public function groups() {
        return $this->hasMany(Group::class);
    }
}
