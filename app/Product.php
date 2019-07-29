<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Product.
 *
 * @property int $id
 * @property int $cafeteria_id
 * @property string $name
 * @property string|null $quantity
 * @property float $price
 * @property string $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Cafeteria $cafeteria
 * @property-read Collection|Category[] $categories
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereCafeteriaId($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereImage($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product whereQuantity($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Product extends Model
{
    /** @var array */
    protected $fillable = [
        'name', 'quantity', 'price', 'image',
    ];

    protected $visible = [
        'name', 'quantity', 'price', 'image', 'cafeteria', 'categories',
    ];

    /**
     * Returns the Cafeteria that owns this Product.
     *
     * @return BelongsTo
     */
    public function cafeteria()
    {
        return $this->belongsTo('App\Cafeteria');
    }

    /**
     * Returns a Collection of categories that are tagged in this Product.
     *
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    /**
     * Returns a relative URL to access Product's image.
     *
     * @return string
     */
    public function getImageAttribute()
    {
        if (!empty($this->image) && file_exists(public_path('img/'.$this->image))) {
            return asset('img/'.$this->image);
        } else {
            return asset('img/food_placeholder.jpg');
        }
    }

    /**
     * Ensures Product name is formatted correctly before saving.
     *
     * @param string $name
     * @return string
     */
    public function setNameAttribute(string $name)
    {
        return ucwords(mb_strtolower($name));
    }
}