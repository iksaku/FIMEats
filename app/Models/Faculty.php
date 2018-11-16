<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Faculty
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faculty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faculty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faculty query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $short_name
 * @property string|null $maps_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cafeteria[] $cafeterias
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faculty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faculty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faculty whereMapsUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faculty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faculty whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Faculty whereUpdatedAt($value)
 */
class Faculty extends Model
{
    protected $fillable = ['name', 'short_name', 'maps_url'];

    public function cafeterias() {
        return $this->hasMany('App\Models\Cafeteria');
    }

    public function name() {
        return ucwords(strtolower($this->name));
    }
}
