<?php

namespace App\Models;

use App\Models\EntityType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Entity extends Model
{
    //
    protected $table = 'entities';
    protected $fillable = [
        'title',
        'logo',
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
    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
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
        return $this->belongsTo('App\Models\Publisher','publisher_id', 'id');
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

