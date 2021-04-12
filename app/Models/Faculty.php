<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faculty extends Model
{
    /** @var array */
    protected $fillable = [
        'name', 'short_name', 'logo', 'maps_url',
    ];

    /** @var array */
    protected $visible = [
        'name', 'short_name', 'logo', 'maps_url', 'cafeterias',
    ];

    /*
     * Returns a Collection of Cafeterias owned by this Faculty.
     */
    public function cafeterias(): HasMany
    {
        return $this->hasMany(Cafeteria::class);
    }

    /*
     * Returns a pre-formatted URL to access Faculty's Logo.
     */
    public function getLogoAttribute(string $value): string
    {
        return asset('img/'.$value);
    }

    /*
     * Ensures Faculty name is formatted correctly before saving.
     */
    public function setNameAttribute(string $value)
    {
        $this->attributes['name'] = ucwords(mb_strtolower($value));
    }

    /*
     * Ensures Faculty short name is formatted correctly before saving.
     */
    public function setShortNameAttribute(string $value)
    {
        $this->attributes['short_name'] = mb_strtoupper($value);
    }

    /*
     * Ensures that Implicit Route Binding uses the 'short_name' column to get the model.
     */
    public function getRouteKeyName(): string
    {
        return 'short_name';
    }
}
