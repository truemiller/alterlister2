<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Cocur\Slugify\Slugify;

class SubmitController extends Controller
{
    //
    public function index()
    {
        return view('submit.index');
    }

    public function submit(Request $request)
    {

        $validator = $request->validate([
            "title"=>"required|string|max:255",
            "description"=>"required|string|max:1000",
            "logo"=>"required|image|max:10000",
            "featured_image"=>"required|image|max:10000",
        ]);

        if ($validator) {
            $logo = $request->file("logo");
            $featured_image = $request->file("featured_image");
            $slugify = new Slugify();
            $slug = $slugify->slugify($request->title);
            return Redirect::back()->with(["msg" => "Submitted successfully $slug", "class" => "alert-success"]);
        } else {
            return Redirect::back()->with(["msg" => "There's something wrong with your submission.", "class" => "alert-danger"]);
        }

    }
}
