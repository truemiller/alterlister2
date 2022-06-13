<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Platform
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $title
 * @property string $fa
 * @property string $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity[] $entities
 * @property-read int|null $entities_count
 * @method static \Illuminate\Database\Eloquent\Builder|Platform newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Platform newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Platform query()
 * @method static \Illuminate\Database\Eloquent\Builder|Platform whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Platform whereFa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Platform whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Platform whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Platform whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Platform whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Platform extends Model
{
    //
    protected $fillable = ['title', 'slug', 'fa'];

    #region Relationships
    public function entities()
    {
        return $this->belongsToMany(Entity::class, 'entity_platform');
    }
    #endregion
}
