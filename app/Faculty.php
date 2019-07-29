<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Faculty.
 *
 * @property int $id
 * @property string $name
 * @property string $short_name
 * @property string|null $maps_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Cafeteria[] $cafeterias
 * @property-read string $logo
 * @method static Builder|Faculty newModelQuery()
 * @method static Builder|Faculty newQuery()
 * @method static Builder|Faculty query()
 * @method static Builder|Faculty whereCreatedAt($value)
 * @method static Builder|Faculty whereId($value)
 * @method static Builder|Faculty whereMapsUrl($value)
 * @method static Builder|Faculty whereName($value)
 * @method static Builder|Faculty whereShortName($value)
 * @method static Builder|Faculty whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Faculty extends Model
{
    /** @var array */
    protected $fillable = [
        'name', 'short_name', 'maps_url',
    ];

    /** @var array */
    protected $visible = [
        'name', 'short_name', 'logo', 'maps_url', 'cafeterias',
    ];

    /**
     * Returns a Collection of Cafeterias owned by this Faculty.
     *
     * @return HasMany
     */
    public function cafeterias()
    {
        return $this->hasMany(Cafeteria::class);
    }

    /**
     * Returns a pre-formatted URL to access Faculty's Logo.
     *
     * @return string
     */
    public function getLogoAttribute()
    {
        return asset('img/'.mb_strtolower($this->short_name)).'.png';
    }

    /**
     * Ensures Faculty name is formatted correctly before saving.
     *
     * @param string $name
     * @return string
     */
    public function setNameAttribute(string $name)
    {
        return ucwords(mb_strtolower($name));
    }

    /**
     * Ensures Faculty short name is formatted correctly before saving.
     *
     * @param string $short_name
     * @return string
     */
    public function setShortNameAttribute(string $short_name)
    {
        return mb_strtoupper($short_name);
    }
}
