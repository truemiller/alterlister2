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




Route::middleware("firewall.all")->group(function (){
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

// Redirects
    Route::permanentRedirect("/localbitcoins-alternatives", "/localbitcoins");
    Route::permanentRedirect("/binance-alternatives", "/binance");
    Route::permanentRedirect("/spotify-alternatives", "/spotify");
    Route::permanentRedirect("/saaavn-alternatives", "/saavn");
    Route::permanentRedirect("/itunes-alternatives", "/itunes");
    Route::permanentRedirect("/slack-alternatives", "/slack");
    Route::permanentRedirect("/snapchat-alternatives", "/snapchat");
    Route::permanentRedirect("/whatsapp-alternatives", "/whatsapp");
    Route::permanentRedirect("/photoscape-alternatives", "/photoscape");
    Route::permanentRedirect("/skype-alternatives", "/skype");
    Route::permanentRedirect("/photoshop-alternatives", "/photoshop");
    Route::permanentRedirect("/coin98-alternatives", "/coin98");
    Route::permanentRedirect("/tidal-alternatives", "/tidal");
    Route::permanentRedirect("/mypaint-alternatives", "/mypaint");
    Route::permanentRedirect("/etoro-alternatives", "/etoro");
    Route::permanentRedirect("/chrome-alternatives", "/chrome");
    Route::permanentRedirect("/coinbase-alternatives", "/coinbase");
    Route::permanentRedirect("/kik-alternatives", "/kik");
    Route::permanentRedirect("/telegram-alternatives", "/telegram");
    Route::permanentRedirect("/kraken-alternatives", "/kraken");
    Route::permanentRedirect("/deezer-alternatives", "/deezer");
    Route::permanentRedirect("/eclipse-alternatives", "/eclipse");
    Route::permanentRedirect("/soundcloud-alternatives", "/soundcloud");
    Route::permanentRedirect("/wechat-alternatives", "/wechat");
    Route::permanentRedirect("/coinmama-alternatives", "/coinmama");
    Route::permanentRedirect("/affinity-photo-alternatives", "/affinity-photo");
    Route::permanentRedirect("/facebook-messenger-alternatives", "/facebook-messenger");
    Route::permanentRedirect("/viber-alternatives", "/viber");
    Route::permanentRedirect("/firefox-alternatives", "/firefox");
    Route::permanentRedirect("/visual-studio-alternatives", "/visual-studio");
    Route::permanentRedirect("/apache-netbeans-alternatives", "/apache-netbeans");
    Route::permanentRedirect("/math-wallet-alternatives", "/math-wallet");
    Route::permanentRedirect("/brave-alternatives", "/brave");
    Route::permanentRedirect("/paint-net-alternatives", "/paint-net");
    Route::permanentRedirect("/youtube-music-alternatives", "/youtube-music");
    Route::permanentRedirect("/obs-alternatives-free", "/obs");

// Search
    Route::get('/search', [SearchController::class,'get'])->name("search");

// Entity
    Route::get('/{ent}', [EntityController::class,'getByEntity'])
         ->name('ent');

// Category
    Route::get('/category/{cat}', [CategoryController::class,'index'])
         ->name('cat');
});




