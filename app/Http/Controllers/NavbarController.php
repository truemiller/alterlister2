<?php

namespace App\Http\Controllers;

use App\Models\Category;

class NavbarController extends Controller
{
    //
    public static function getNavbarCategories()
    {
        return Category::get();
    }
}
