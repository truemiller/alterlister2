<?php
//
//use Illuminate\Routing\Route;
//use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




//Route::middleware("firewall.all")->group(function (){
    Auth::routes();
    // Home
    Route::middleware("auth")->group(function(){

        Route::get('/home', [\App\Http\Controllers\HomeController::class, "index"]);
        Route::get('/review_post', [\App\Http\Controllers\ReviewController::class, "postReview"])->name("review.post");
//
        Route::get('/submit', [\App\Http\Controllers\SubmitController::class, "index"])->name('submit');
        Route::post('/submit_post', [\App\Http\Controllers\SubmitController::class, "submit"])->name("submit.post");

        Route::get('/delete_entity/{entity_id}', [EntityController::class, "deleteEntity"])->name('entity.delete');

        Route::get('/edit_entity/{entity_id}', [\App\Http\Controllers\SubmitController::class, "edit"])->name('entity.edit');
        Route::post('/update_entity', [\App\Http\Controllers\SubmitController::class, "update"])->name('entity.update');

        Route::get('/submissions', [\App\Http\Controllers\SubmitController::class, 'list'])->name('submissions');
    });

    Route::get('/',  [\App\Http\Controllers\HomeController::class, "index"])
         ->name('home');

// About
    Route::get('/about', function (){
        return view('pages.about');
    })->name("about");

    Route::get('/privacy', function (){
        return view('pages.privacy');
    })->name("privacy");

    Route::get('/terms', function (){
        return view('pages.terms');
    })->name("terms");

    Route::get('/software', function (){
        return view('pages.software');
    })->name('software');

    Route::get('/categories', function (){
        return view('pages.categories');
    });

// Sitemap
    Route::get('/sitemap.xml', [SitemapController::class,'index'])
         ->name('sitemap.index');

// Search
    Route::get('/search', [SearchController::class,'get'])->name("search");

// Entity
    Route::get('/to/{ent}', [EntityController::class,'getByEntity'])
         ->name('ent');

// Category
    Route::get('/category/{cat}', [CategoryController::class,'index'])
         ->name('cat');
//});




