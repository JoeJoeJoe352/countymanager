<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\County
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|County newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|County newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|County query()
 * @method static \Illuminate\Database\Eloquent\Builder|County whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|County whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|County whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|County whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\City> $cities
 * @property-read int|null $cities_count
 * @mixin \Eloquent
 */
class County extends Model {

    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'county';

    /**
     * Get the cities, belonging to this county.
     */
    public function cities() {
        return $this->hasMany('App\Models\City');
    }
}
