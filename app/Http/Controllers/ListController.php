<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Entity;

class ListController extends Controller
{
    //
    public function index()
    {
        // Variables that will hold the entities for the homepage
        $newest = [];
        $popular = [];
        $categories = [];

        // Get the newest entities by view count
        $newest = Entity::get()
            ->sortBy(function ($ent) {
                return $ent->updated_at;
            });//->take(4);

        // Get the most popular entities by view count
        $popular = Entity::get()
            ->sortByDesc(function ($_ent) {
                return $_ent->getViews();
            });//->take(4);

        $categories = Category::whereHas('entities', function ($q) {
            return $q;
        })->get();

        return view('list')->with(
            [
                'newest' => $newest,
                'popular' => $popular,
                'categories' => $categories
            ]
        );
    }

    public function category($category)
    {
        // Variables that will hold the entities for the homepage
        $newest = [];
        $popular = [];
        $categories = [];

        // Get Entities from the category
        $entities =
            Entity::whereHas('parent', function ($q) use ($category) {
                return $q->where('slug', $category);
            })->get();


        // Get the newest entities by view count
        $newest = $entities
            ->sortBy(function ($ent) {
                return $ent->updated_at;
            });
        //->take(4);

        // Get the most popular entities by view count
        $popular = $entities
            ->sortByDesc(function ($_ent) {
                return $_ent->getViews();
            });
        //->take(4);

        $categories = Category::whereHas('entities', function ($q) {
            return $q;
        })->get();

        return view('list')->with(
            [
                'newest' => $newest,
                'popular' => $popular,
                'categories' => $categories
            ]
        );
    }

    public function entity($entity)
    {
        // Variables that will hold the entities for the homepage
        $newest = [];
        $popular = [];
        $categories = [];

        // Get the newest entities by view count
        $newest = Entity::get()
            ->sortBy(function ($ent) {
                return $ent->updated_at;
            });//->take(4);

        // Get the most popular entities by view count
        $popular = Entity::get()
            ->sortByDesc(function ($_ent) {
                return $_ent->getViews();
            });//->take(4);

        $categories = Category::whereHas('entities', function ($q) {
            return $q;
        })->get();

        return view('list')->with(
            [
                'newest' => $newest,
                'popular' => $popular,
                'categories' => $categories
            ]
        );
    }
}
