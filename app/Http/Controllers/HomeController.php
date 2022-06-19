<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Entity;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Variables that will hold the entities for the homepage
        $newest = [];
        $popular = [];
        $categories = [];

        // Get the newest entities by view count
        $latest_entities = Entity::
        where("active", true)
                                 ->orderBy('id', 'desc')
                                 ->take(16)
                                 ->get();

        // Get the most popular entities by view count
//        $trending_entities = Entity::get()
//            ->sortByDesc(function ($_ent) {
//                return $_ent->getViews();
//            })
//            ->take(132);

        $popular_entities = Entity::where("active", true)->get()
                                  ->sortByDesc(function ($_ent) {
                                      return $_ent->getViews();
                                  })
                                  ->take(16);


        return view('homepage')->with(
            [
                'latest_entities' => $latest_entities,
                'popular_entities' => $popular_entities,
//                'trending_entities' => $trending_entities
            ]
        );
    }
}
