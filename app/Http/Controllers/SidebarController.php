<?php

namespace App\Http\Controllers;

use App\Models\Entity;

class SidebarController extends Controller
{
    //
    public static function MostPopular($n)
    {
        if (is_numeric($n)) {
            return Entity::with('events')->get()
                ->sortBy(function ($entity) {
//                    return $entity->getViews();
                    return $entity->views;
                });//->take($n);
        } else {
            return null;
        }
    }
}
