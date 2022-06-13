<?php

namespace App\Http\Controllers;

class SitemapController extends Controller
{
    //
    public function index()
    {
        return response()->view('sitemap.index')->header('content-type', 'application/xml');
    }

//	public function entities()
//	{
//		$posts = Entity::active()->where('category_id', '!=', 21)->get();
//		return response()->view('sitemap.posts', [
//			'ent' => ent,
//		])->header('Content-Type', 'text/xml');
//	}
//
//	public function categories()
//	{
//		$categories = Category::all();
//		return response()->view('sitemap.categories', [
//			'categories' => $categories,
//		])->header('Content-Type', 'text/xml');
//	}
}
