<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Consumable
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consumable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consumable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consumable query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $menu_id
 * @property string $name
 * @property float $price
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consumable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consumable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consumable whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consumable whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consumable whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consumable wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consumable whereUpdatedAt($value)
 */
class Consumable extends Model
{
    /** @var array */
    protected $fillable = ['name', 'price', 'image'];

    /**
     * Returns the Cafeteria that owns this Consumable
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cafeteria() {
        return $this->belongsTo('App\Models\Cafeteria');
    }

    /**
     * Returns a Collection of categories that are tagged in this Consumable
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories() {
        return $this->belongsToMany('App\Models\Category');
    }

    /**
     * Returns formatted Consumable's full name
     *
     * @return string
     */
    public function name() {
        return ucwords(mb_strtolower($this->name));
    }

    /**
     * Returns formatted Consumable's price
     *
     * @return string
     */
    public function price() {
        return '$' . $this->price;
    }

    /**
     * Returns a pre-formatted URL to access Consumable's image
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
