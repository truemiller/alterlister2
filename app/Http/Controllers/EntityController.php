<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Entity;

class EntityController extends Controller
{
    //
    public function getByEntity($ent)
    {
        // Populate variables for return
        $entity = (new Entity)
            ->where(['slug' => $ent, "active" => true])
            ->firstOrFail();

        EventController::createEventEntity('view', $ent);

        $alternatives = $entity->alternatives();

        $views = $entity->events->count();

        // Return the view to the user
        return view('entity.view')
            ->with([
                'entity' => $entity,
                'alternatives' => $alternatives,
                'views' => $views
            ]);
    }

    public function getByCategory($category)
    {
        $entities = (new Category)->firstWhere('slug', $category);

        return view('list')
            ->with([
                'categories' => CategoryController::getCategoryAll(),
                'category' => $entities,
                'entities' => $entities->entities()->where(["active" => true])->get()
            ]);

    }
}
