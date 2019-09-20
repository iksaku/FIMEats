<?php

namespace App;

use App\Traits\CdnImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Faculty.
 *
 * @property int $id
 * @property string $name
 * @property string $short_name
 * @property string|null $maps_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Cafeteria[] $cafeterias
 * @property-read int|null $cafeterias_count
 * @property-read string $logo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faculty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faculty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faculty query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faculty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faculty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faculty whereMapsUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faculty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faculty whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faculty whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Faculty extends Model
{
    use CdnImage;

    /** @var array */
    protected $fillable = [
        'name', 'short_name', 'logo', 'maps_url',
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
    public function cafeterias(): HasMany
    {
        return $this->hasMany(Cafeteria::class);
    }

    /**
     * Returns a pre-formatted URL to access Faculty's Logo.
     *
     * @param string $value
     * @return string
     */
    public function getLogoAttribute(string $value): string
    {
        return $this->getImage($value);
    }

    /**
     * Ensures Faculty name is formatted correctly before saving.
     *
     * @param string $value
     */
    public function setNameAttribute(string $value)
    {
        $this->attributes['name'] = ucwords(mb_strtolower($value));
    }

    /**
     * Ensures Faculty short name is formatted correctly before saving.
     *
     * @param string $value
     */
    public function setShortNameAttribute(string $value)
    {
        $this->attributes['short_name'] = mb_strtoupper($value);
    }
}
