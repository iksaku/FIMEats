<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * App\Cafeteria.
 *
 * @property int $id
 * @property int $faculty_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Faculty $faculty
 * @property-read mixed $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cafeteria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cafeteria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cafeteria query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cafeteria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cafeteria whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cafeteria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cafeteria whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cafeteria whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Cafeteria extends Model
{
    /** @var array */
    protected $fillable = [
        'name',
    ];

    /** @var array */
    protected $visible = [
        'name', 'faculty', 'products',
    ];

    /** @var array */
    protected $appends = [
        'slug',
    ];

    /*
     * Returns the Faculty that owns this Cafeteria.
     */
    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }

    /*
     * Returns a Collection of products available at this Cafeteria.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /*
     * Returns slugged name of Cafeteria
     */
    public function getSlugAttribute(): string
    {
        return Str::slug($this->name);
    }
}
