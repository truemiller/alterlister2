<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Entity;
use App\Models\EntityTag;
use App\Models\Platform;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use GuzzleHttp\Client;

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
            "title" => "required|string|max:255|unique:entities,title",
            "description" => "required|string|max:10000|unique:entities,description",
            "logo" => "required|image|max:10000|mimes:jpg,bmp,png,webp,gif",
            "category_id" => "required|integer|min:0",
            "link_1" => "required|url|unique:entities,link_1",
            "tags" => "required|string|min:1"
        ]);


        if ($validator) {

            // IMAGE
            $logo = $request->file("logo");
            $logoExtension = $logo->extension();
            $slug = Str::slug($request->title, "-");
            $filename = "$slug.$logoExtension";
            $path = public_path("img/logo/created/$filename");
            $resize = Image::make($logo->getRealPath());

            // ENTITY
            $entity = Entity::create([
                "slug" => $slug,
                "title" => $request->title,
                "description" => $request->description,
                "logo" => asset('img/logo/created/' . $slug . "." . $logoExtension),
                "category_id" => Category::firstWhere("id", $request->category_id)->id,
                "user_id" => Auth::id(),
                "link_1" => $request->link_1,
                "active" => true
            ]);

            // TAGS
            $tags = explode(",", $request->tags);
            foreach ($tags as $tag) {
                if (strlen($tag) >= 1) {
                    $_tag = Tag::updateOrCreate([
                        "tag" => Str::slug(Str::lower($tag), " ")
                    ]);
                    $_entityTag = EntityTag::updateOrCreate([
                        "entity_slug" => $entity->slug,
                        "tag" => $_tag->tag
                    ]);
                } else {
                    // discard empty tag
                }

            }

            // PLATFORMS
            foreach ($request->platform as $platform_id) {
                $platform = Platform::firstWhere('id', $platform_id);
                $entity->platforms()->attach($platform);
            }


            // CREATE IMAGE
            if (File::exists($path)) {
                File::delete($path);
            }
            $resize->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($path, 90);


            // PING SITEMAP
            if (env("APP_ENV") === "production") {
                $client = new Client();
                $client->request('GET', 'http://www.google.com/webmasters/sitemaps/ping?sitemap=' . route('sitemap.index'));
            }

            return Redirect::back()->with(["msg" => "Submitted successfully $slug", "class" => "alert-success"]);
        } else {
            return Redirect::back()->with(["msg" => "There's something wrong with your submission.", "class" => "alert-danger"]);
        }

    }

    public function list()
    {
        return view('submit.list', ["submissions" => Auth::user()->entities]);
    }

    public function update(Request $request)
    {
        $validator = $request->validate([
            "slug" => "required|string|exists:entities,slug",
            "title" => "string|required",
            "description" => "required|string|max:10000",
            "logo" => "nullable|image|max:10000",
            "category_id" => "required|integer|min:0",
            "link_1" => "required|url",
            "tags" => "required|string|min:1"
        ]);

        if ($validator) {
            $entity = Entity::firstWhere(["slug" => $request->slug, "user_id" => Auth::id()]);


            // CATEGORY
            $category = Category::firstWhere("id", $request->category_id);

            // ENTITY
            (new \App\Models\Entity)->update(
                [
                    "slug" => $entity->slug,
                    "user_id" => Auth::id()
                ],
                [
                    "description" => $request->description,
                    "category_id" => $category->id,
                    "link_1" => $request->link_1
                ]
            );

            // TAGS

            EntityTag::where('entity_slug', $entity->slug)->delete();

            $tags = explode(",", $request->tags);
            foreach ($tags as $tag) {
                if (strlen($tag) >= 1) {
                    $_tag = Tag::updateOrCreate([
                        "tag" => Str::slug(Str::lower($tag), " ")
                    ]);
                    $_entityTag = EntityTag::updateOrCreate([
                        "entity_slug" => $entity->slug,
                        "tag" => $_tag->tag
                    ]);
                } else {
                    // discard empty tag
                }

            }

            // PLATFORMS
            $entity->platforms()->detach();
            foreach ($request->platform as $platform_id) {
                $platform = Platform::firstWhere('id', $platform_id);
                $entity->platforms()->attach($platform);
            }


            // CREATE IMAGE
            // IMAGE
            if ($request->logo) {
                $logo = $request->file("logo");
                $logoExtension = $logo->extension();
                $entity->update([
                    "logo" => asset('img/logo/created/' . $entity->slug . "." . $logoExtension)]);
                $filename = "$entity->slug.$logoExtension";
                $path = public_path("img/logo/created/$filename");
                $resize = Image::make($logo->getRealPath());
                if (File::exists($path)) {
                    File::delete($path);
                }
                $resize->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($path, 90);
            }


            // PING SITEMAP
            if (env("APP_ENV") === "production") {
                $client = new Client();
                $client->request('GET', 'http://www.google.com/webmasters/sitemaps/ping?sitemap=' . route('sitemap.index'));
            }

            return Redirect::back()->with(["msg" => "Submitted successfully $entity->slug", "class" => "alert-success"]);
        }


    }

    public function edit($entity_id)
    {
        $entity = Auth::user()->entities()->where("id", $entity_id)->firstOrFail();
        return view('submit.edit', ["entity" => $entity]);
    }
}
