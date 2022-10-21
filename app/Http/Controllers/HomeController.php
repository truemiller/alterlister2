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

        $latest_entities = Entity::where("active", true)
                                 ->orderBy('id', 'desc')
                                 ->take(16)
                                 ->get();


        $popular_entities = Entity::where("active", true)->get()
                                  ->sortByDesc(function ($_ent) {
                                      return $_ent->views;
                                  })
                                  ->take(16);

        return view('homepage')->with(
            [
                'latest_entities' => $latest_entities,
                'popular_entities' => $popular_entities
            ]
        );
    }
}
