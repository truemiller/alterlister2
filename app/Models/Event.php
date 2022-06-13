<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Event
 *
 * @package App
 * @mixin Eloquent
 */
class Event extends Model
{
    //
    protected $fillable = ["ip_address", 'referer', 'user_agent'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class, 'entity_slug', 'slug');
    }

    public function event_type()
    {
        return $this->belongsTo(EventType::class, 'event_type_id', 'id');
    }
}
