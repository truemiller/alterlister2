<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Event;
use App\Models\EventType;

/**
 * Class EventController
 * @package App\Http\Controllers
 * @mixin Eloquent
 */
class EventController extends Controller
{
    //
    public static function createEventEntity($slug, $entity)
    {
        // capture ip
        $clientIP = request()->ip();
        $clientReferer = request()->headers->get('referer');
        $clientUserAgent = request()->headers->get('user_agent');

        $_entity = Entity::whereSlug($entity)->first();
        $eventType = EventType::whereType("view")->first();

        // fire view event
        $viewEvent = new Event([
            'ip_address' => $clientIP,
            'referer' => $clientReferer,
            'user_agent' => $clientUserAgent
        ]);

        $viewEvent->event_type()->associate($eventType);
        $viewEvent->entity()->associate($_entity);

        $viewEvent->save();
    }

    public static function createEventEntityLike($ent)
    {
        $entity = Entity::firstWhere('slug', $ent);
        // capture ip
        $clientIP = request()->ip();
        $clientReferer = request()->headers->get('referer');
        $clientUserAgent = request()->headers->get('user_agent');
        // fire view event
        $viewEvent = new Event(['ip_address' => $clientIP, 'referer' => $clientReferer, 'user_agent' => $clientUserAgent]);
        $viewEventType = (new \App\EventType)->where('type', '=', 'like')->first();
        $viewEvent->event_type()->associate($viewEventType);
        $viewEvent->entity()->associate($entity);
        $viewEvent->save();
    }
}
