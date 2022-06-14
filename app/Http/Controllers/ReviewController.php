<?php

namespace App\Http\Controllers;


use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ReviewController extends Controller
{
    //
    public function postReview(Request $request)
    {
        Review::create([
            "user_id"=>Auth::id(),
            "entity_id"=>$request->entity_id,
            "review"=>$request->review,
            "stars"=>$request->stars
        ]);

        return Redirect::back();
    }
}
