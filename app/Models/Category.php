<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    /** @var array */
    protected $fillable = [
        'name',
    ];

    protected $visible = [
        'name', 'products',
    ];

    /*
     * Returns a Collection of products that are tagged with this Category.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    /*
     * Ensures Category name is formatted correctly before saving.
     */
    public function setNameAttribute(string $value)
    {
        $this->attributes['name'] = ucwords(mb_strtolower($value));
    }
}
