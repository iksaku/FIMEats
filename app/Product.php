<?php

namespace App;

use App\Traits\CdnImage;
use Illuminate\Database\Eloquent\Collection;
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
    use CdnImage;

    /** @var array */
    protected $fillable = [
        'name', 'quantity', 'price', 'image',
    ];

    protected $visible = [
        'id', 'name', 'quantity', 'price', 'image', 'cafeteria', 'categories',
    ];

    /**
     * Returns the Cafeteria that owns this Product.
     *
     * @return BelongsTo
     */
    public function cafeteria(): BelongsTo
    {
        return $this->belongsTo('App\Cafeteria');
    }

    /**
     * Returns a Collection of categories that are tagged in this Product.
     *
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany('App\Category');
    }

    /**
     * Returns a relative URL to access Product's image.
     *
     * @param string|null $value
     * @return string
     */
    public function getImageAttribute($value): string
    {
        return $this->getImage($value);
    }

    /**
     * Ensures Product name is formatted correctly before saving.
     *
     * @param string $value
     */
    public function setNameAttribute(string $value)
    {
        $this->attributes['name'] = ucwords(mb_strtolower($value));
    }

    /**
     * Intercepts object normalization and injects custom structured categories data.
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_replace(parent::toArray(), [
            'categories' => $this->categories->pluck('name')->all(),
        ]);
    }
}
