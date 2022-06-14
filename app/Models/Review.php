<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Review extends Model
{
    protected $fillable = ["user_id", "entity_id", "review", "stars"];
    //
    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
