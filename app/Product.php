<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Product.
 *
 * @property int $id
 * @property int $cafeteria_id
 * @property string $name
 * @property string|null $quantity
 * @property float $price
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Cafeteria $cafeteria
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categories
 * @property-read int|null $categories_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCafeteriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    /** @var array */
    protected $fillable = [
        'name', 'quantity', 'price', 'image',
    ];

    /** @var array */
    protected $visible = [
        'name', 'quantity', 'price', 'image', 'cafeteria', 'categories',
    ];

    /*
     * Returns the Cafeteria that owns this Product.
     */
    public function cafeteria(): BelongsTo
    {
        return $this->belongsTo('App\Cafeteria');
    }

    /*
     * Returns a Collection of categories that are tagged in this Product.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany('App\Category');
    }

    /*
     * Returns a relative URL to access Product's image.
     */
    public function getImageAttribute($value): string
    {
        if (empty($value)) {
            $value = 'food_placeholder.jpg';
        }

        return asset('img/'.$value);
    }

    /*
     * Ensures Product name is formatted correctly before saving.
     */
    public function setNameAttribute(string $value)
    {
        $this->attributes['name'] = ucwords(mb_strtolower($value));
    }

    /*
     * Ensures that Implicit Route Binding uses the 'name' column to get the model.
     */
    public function getRouteKeyName(): string
    {
        return 'name';
    }
}
