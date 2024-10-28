<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('page.home');
// });

// Route::get('/home', function () {
//     return view('page.home');
// });
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/event', [HomeController::class, 'event']);
Route::get('/podcast', [HomeController::class, 'podcast']);
Route::get('/detail-podcast/{slug}', [HomeController::class, 'detailpodcast']);
// Route::get('/event', function () {
//     return view('page.event');
// });

// Route::get('/podcast', function () {
//     return view('page.podcast');
// });

// Route::get('/detail-podcast', function () {
//     return view('page.detailPodcast');
// });

Route::get('/chart', function () {
    return view('page.chart');
});

Route::get('/ardan-youtube' , function () {
    return view('page.youtube');
});


Route::get('/info-news' , function () {
    return view('page.infoNews');
});



