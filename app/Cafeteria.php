<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Cafeteria.
 *
 * @property int $id
 * @property int $faculty_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Faculty $faculty
 * @property-read Collection|Product[] $products
 * @method static Builder|Cafeteria newModelQuery()
 * @method static Builder|Cafeteria newQuery()
 * @method static Builder|Cafeteria query()
 * @method static Builder|Cafeteria whereCreatedAt($value)
 * @method static Builder|Cafeteria whereFacultyId($value)
 * @method static Builder|Cafeteria whereId($value)
 * @method static Builder|Cafeteria whereName($value)
 * @method static Builder|Cafeteria whereUpdatedAt($value)
 * @mixin Eloquent
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

    /**
     * Returns the Faculty that owns this Cafeteria.
     *
     * @return BelongsTo
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    /**
     * Returns a Collection of products available at this Cafeteria.
     *
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
