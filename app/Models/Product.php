<?php

namespace App\Models;

use App\Models\Group\Group;
use App\Models\Cart\CartProduct;
use App\Models\Order\OrderProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use SoftDeletes, HasSlug, HasTranslations;

    protected $fillable = ['name', 'slug', 'image', 'description', 'price', 'state', 'category_id'];

    protected $casts = [ 
        'name' => 'array',
        'description' => 'array'
    ];

    /**
     * Get the state.
     *
     * @return string
     */
    public function getStateAttribute($value)
    {
        if ($value=='3') {
            return trans('admin.values_attributes.states.products.out of stock');
        } elseif ($value=='2') {
            return trans('admin.values_attributes.states.products.not available');
        } elseif ($value=='1') {
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
        $product=$this->with(['category', 'groups.complements'])->where($field, $value)->first();
        if (!is_null($product)) {
            return $product;
        }

        return abort(404);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug')->slugsShouldBeNoLongerThan(191)->doNotGenerateSlugsOnUpdate();
    }

    public $translatable = ['name', 'description'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function groups() {
        return $this->belongsToMany(Group::class)->withTimestamps();
    }

    public function cart_products() {
        return $this->hasMany(CartProduct::class);
    }

    public function order_products() {
        return $this->hasMany(OrderProduct::class);
    }
}
