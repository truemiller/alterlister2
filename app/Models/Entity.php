<?php

namespace App\Models;

use App\Models\EntityType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Entity
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string|null $short_description
 * @property string|null $long_description
 * @property string $logo
 * @property string|null $link_1
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $price
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property-read int|null $events_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $parents
 * @property-read int|null $parents_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Platform[] $platforms
 * @property-read int|null $platforms_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Entity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereLink1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereLongDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Entity extends Model
{
    //
    protected $table = 'entities';
    protected $fillable = [
        'title',
        'short_description',
        'long_description',
        'logo',
        'image_1',
        'video_1',
        'slug',
        'price',
        'link_1'
    ];

    #region Relations

    //  Event tracking; views, shares and stuff
    public function events()
    {
        return $this->hasMany(Event::class, 'entity_slug', 'slug');
    }

    //  Parent containing category
    public function parents()
    {
        return $this->belongsToMany(Category::class, 'category_entity', 'entity_id', 'category_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function tags()
    {
        return $this->hasManyThrough(Tag::class, "App\Models\EntityTag", "entity_slug", "tag", "slug", "tag");
    }

    public function alternatives()
    {
        $alternatives = collect();

        foreach($this->tags as $tag){
            $alternatives=$alternatives->merge($tag->entities->where("slug","!=", $this->slug));
        }

        $counter = $alternatives->countBy(function($alt){
            return $alt->slug;
        })->sort()->reverse();

        $sorted = collect();
        foreach ($counter as $slug => $value)
            $sorted->push($alternatives->firstWhere("slug", $slug));

        return $sorted;
    }

    public function platforms()
    {
        return $this->belongsToMany('App\Models\Platform', 'entity_platform');
    }

    public function publisher()
    {
        return $this->belongsTo('App\Models\Publisher','publisher_slug', 'slug');
    }

    #endregion

    #region Traits
    // View count
    public function getViews()
    {
        //return 0;
        return $this->events()
            ->where('event_type_id', 1)
            //->distinct('ip_address')
            ->count();
    }

    // View count
    public function getLikes()
    {
        return 0;
    }
    #endregion
}

