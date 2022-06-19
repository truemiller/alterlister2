<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Entity;

class CategoryController extends Controller
{
    //
    public function get($category_slug)
    {
        $category = Category::firstWhere("slug", $category_slug);
        $subcategories = collect();

        $entities = collect();


        // get direct entities
        $entities->push(
            [
                "category" => $category,
                "entities" => collect($category->entities)
            ]
        );

        foreach ($category->children as $child) {
            $entities->push(["category" => $child, "entities" => collect($child->entities)]);
        }

        return view('list', $entities->take(32));
    }

    public function index($category)
    {
        $category = Category::firstWhere('slug', $category);

        // Variables that will hold the entities for the homepage
        $latest = [];
        $popular = [];
        $categories = [];
        $entities = collect($category->entities->where('active', true));

        // Get Entities from the category
        foreach ($category->children as $child) {
            $entities = $entities->merge($child->entities);
            foreach ($child->children as $childChild) {
                $entities = $entities->merge($childChild->entities);
                foreach ($childChild->children as $childChildChild) {
                    $entities = $entities->merge($childChildChild->entities);
                }
            }
        }

//        $latest = $entities
//            ->sortByDesc('updated_at');

        // Get the most popular entities by view count

        $popular = $entities
            ->sortByDesc(function ($_ent) {
                return $_ent->getViews();
            });

        if ($popular->children->count() > 0) {
            $popular = $popular->take(16);
        }

//        $category =
//            Category::where('slug', $category)->first();

        return view('category')->with(
            [
//                'latest_entities' => $latest,
                'popular_entities' => $popular,
                'category' => $category
            ]
        );
    }

    public static function getCategoryAll()
    {
        return Category::get();
    }
}
