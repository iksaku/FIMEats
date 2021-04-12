<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

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
