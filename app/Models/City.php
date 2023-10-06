<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\City
 *
 * @property int $id
 * @property string $name
 * @property int $county_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCountyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereUpdatedAt($value)
 * @property-read City $county
 * @mixin \Eloquent
 */
class City extends Model
{

    use HasFactory;

    /**
     * Táblanév.
     *
     * @var string
     */
    protected $table = 'city';

    /**
     * Városhoz tartozó megye modell.
     */
    public function county()
    {
        return $this->belongsTo('App\Models\City');
    }

    /**
     * Elmenti az új város modellt
     * @param int $countyId
     * @param string $name
     * @return self
     * @throws \Symfony\Component\CssSelector\Exception\InternalErrorException
     */
    public static function saveNew(int $countyId, string $name): self
    {
        $model = new self();
        $model->name = $name;
        $model->county_id = $countyId;

        if ($model->save())
        {
            return $model;
        } else
        {
            throw new \Symfony\Component\CssSelector\Exception\InternalErrorException("Hiba történt a mentés során");
        }
    }
    
}
