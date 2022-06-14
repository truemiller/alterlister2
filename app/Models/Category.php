<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    // Category > Type > Entity
    protected $fillable =
        ['title', 'description'];

    public function parent()
    {
        return $this
            ->belongsTo(Category::class, 'category_id', 'id');
    }

    public function children()
    {
        return $this
            ->hasMany(Category::class,'category_id', 'id');
    }


    public function entities()
    {
        return $this
            ->hasMany(Entity::class, 'category_id', 'id');
    }

}
