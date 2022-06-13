<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function query($query): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            Entity::query()->where('title', 'LIKE', "%{$query}%")->get()
        );
    }

    public function get(Request $request)
    {
        if ($request->validate(["query"=>"required"]))
        {
            $query = $request["query"];
            return view('search', [
                    "ents" => Entity::query()->where('title', 'LIKE', "%{$request["query"]}%")->get(),
                    "query" => $query
                ]
            );
        } else {
            abort(403);
        }
    }
}
