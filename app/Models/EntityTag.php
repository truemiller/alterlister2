<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntityTag extends Model
{
    //
    public function tag()
    {
        return $this->belongsTo(Tag::class, "tag", "tag");
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class, "entity_slug", "slug");
    }
}
