<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Menu
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $cafeteria_id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Cafeteria $cafeteria
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Consumable[] $consumables
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereCafeteriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereUpdatedAt($value)
 */
class Menu extends Model
{
    protected $fillable = ['name'];

    public function cafeteria() {
        return $this->belongsTo('App\Models\Cafeteria')->get();
    }

    public function consumables() {
        return $this->hasMany('App\Models\Consumable')->get();
    }
}
