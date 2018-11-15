<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Cafeteria
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafeteria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafeteria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafeteria query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $faculty_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Faculty $faculty
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Menu[] $menus
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafeteria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafeteria whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafeteria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafeteria whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cafeteria whereUpdatedAt($value)
 */
class Cafeteria extends Model
{
    protected $fillable = ['name'];

    public function faculty() {
        return $this->belongsTo('App\Models\Faculty');
    }

    public function menus() {
        return $this->hasMany('App\Models\Menu');
    }
}
