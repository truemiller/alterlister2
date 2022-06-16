<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Entity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

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
        $category = (new Category)->firstWhere('slug', $category);

        return view('list')
            ->with([
                'categories' => CategoryController::getCategoryAll(),
                'category' => $category,
                'entities' => $category->entities()->where(["active" => true])->get()
            ]);

    }

    public function deleteEntity($entity_id)
    {
        if (Auth::check()) {
            $entity = Auth::user()->entities->where("id",$entity_id)->firstOrFail();
            if (File::exists($entity->logo)) {
                File::delete($entity->logo);
            }
            $entity->delete();
        }
        return Redirect::back();
    }
}
