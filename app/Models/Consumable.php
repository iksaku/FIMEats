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
    protected $fillable = ['name', 'price', 'image'];

    public function categories() {
        return $this->belongsToMany('App\Models\Category');
    }

    public function name() {
        return ucwords(strtolower($this->name));
    }

    public function price() {
        return '$' . $this->price;
    }

    public function image() {
        if (!empty($this->image) && file_exists(public_path('img/' . $this->image)))
            return asset('img/' . $this->image);
        else
            return asset('img/food_placeholder.jpg');
    }
}
