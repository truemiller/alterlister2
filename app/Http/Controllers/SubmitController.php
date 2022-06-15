<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Entity;
use App\Models\EntityTag;
use App\Models\Platform;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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
            "title" => "required|string|max:255",
            "description" => "required|string|max:10000",
            "logo" => "required|image|max:10000",
            "category_id" => "required|integer|min:0",
            "tags" => "required|string|min:1"
        ]);


        if ($validator) {
//            IMAGE
            $logo = $request->file("logo");
            $logoExtension = $logo->extension();
            $slug = Str::slug($request->title, "-");
            $filename = "$slug.$logoExtension";
            $path = public_path("img/logo/created/$filename");
            $resize = Image::make($logo->getRealPath());
            $resize->resize(100,100)->save($path, 90);

//            ENTITY
            $entity = Entity::create([
                "slug" => $slug,
                "title" => $request->title,
                "description" => $request->description,
                "logo" => asset('img/logo/created/' . $slug . "." . $logoExtension),
                "category_id" => Category::firstWhere("id", $request->category_id)->id
            ]);

//            TAGS
            $tags = explode(",", $request->tags);
            foreach ($tags as $tag) {
                $_tag = Tag::updateOrCreate([
                    "tag" => Str::slug(Str::lower($tag), " ")
                ]);
                $_entityTag = EntityTag::updateOrCreate([
                    "entity_slug" => $entity->slug,
                    "tag" => $_tag->tag
                ]);
            }

//            PLATFORMS
            foreach ($request->platform as $platform_id) {
                $platform = Platform::firstWhere('id', $platform_id);
                $entity->platforms()->attach($platform);
            }

            return Redirect::back()->with(["msg" => "Submitted successfully $slug", "class" => "alert-success"]);
        } else {
            return Redirect::back()->with(["msg" => "There's something wrong with your submission.", "class" => "alert-danger"]);
        }

    }

    public function list()
    {
        return view('submit.list', ["submissions"=>Auth::user()->entities]);
    }
}
