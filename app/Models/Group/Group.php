<?php

namespace App\Models\Group;

use App\Models\Attribute;
use App\Models\Product;
use App\Models\Complement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Group extends Model
{
	use SoftDeletes, HasSlug;

    protected $fillable = ['name', 'slug', 'condition', 'min', 'max', 'state', 'attribute_id'];

    /**
     * Get the condition.
     *
     * @return string
     */
    public function getConditionAttribute($value)
    {
        if ($value=='1') {
            return trans('admin.values_attributes.conditions.required');
        } elseif ($value=='0') {
            return trans('admin.values_attributes.conditions.optional');
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
        $group=$this->with(['attribute', 'complements'])->where($field, $value)->first();
        if (!is_null($group)) {
            return $group;
        }

        return abort(404);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug')->slugsShouldBeNoLongerThan(191)->doNotGenerateSlugsOnUpdate();
    }

    public function attribute() {
        return $this->belongsTo(Attribute::class);
    }

    public function complements() {
        return $this->belongsToMany(Complement::class)->withPivot('id', 'price', 'state')->withTimestamps();
    }

    public function products() {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
}
