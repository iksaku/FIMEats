<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $menu_id
 * @property string $name
 * @property float $price
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereUpdatedAt($value)
 */
class Product extends Model
{
    /** @var array */
    protected $fillable = ['name', 'price', 'image'];

    /**
     * Returns the Cafeteria that owns this Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cafeteria() {
        return $this->belongsTo('App\Models\Cafeteria');
    }

    /**
     * Returns a Collection of categories that are tagged in this Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories() {
        return $this->belongsToMany('App\Models\Category');
    }

    /**
     * Returns formatted Product's full name
     *
     * @return string
     */
    public function name() {
        return ucwords(mb_strtolower($this->name));
    }

    /**
     * Returns formatted Product's price
     *
     * @return string
     */
    public function price() {
        return '$' . $this->price;
    }

    /**
     * Returns a pre-formatted URL to access Product's image
     *
     * @return string
     */
    public function image() {
        if (!empty($this->image) && file_exists(public_path('img/' . $this->image)))
            return asset('img/' . $this->image);
        else
            return asset('img/food_placeholder.jpg');
    }
}
