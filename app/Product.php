<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

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
        'id', 'name', 'quantity', 'price', 'image', 'cafeteria', 'categories',
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
     * @param string|null $value
     * @return string
     */
    public function getImageAttribute($value)
    {
        return Cache::tags(['cdn', 'image'])->rememberForever($value, function () use ($value) {
            $img = 'img/'.$value;

            try {
                if (Storage::cloud()->has($img)) {
                    return Storage::cloud()->url($img);
                }

                return Storage::cloud()->get('img/food_placeholder.jpg');
            } catch (InvalidArgumentException $exception) {
                if (file_exists(public_path($img))) {
                    return asset($img);
                }

                return asset('img/food_placeholder.jpg');
            }
        });
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
    public function toArray()
    {
        return array_replace(parent::toArray(), [
            'categories' => $this->categories->pluck('name')->all(),
        ]);
    }
}
