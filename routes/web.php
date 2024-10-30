<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaylistController;

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

Route::get('/chart', [HomeController::class, 'chart']);

Route::get('/info-news', [HomeController::class, 'info']);

Route::get('/ardan-youtube', [HomeController::class, 'youtube']);



Route::get('/api/playlists', [PlaylistController::class, 'getPlaylists']);
Route::get('/api/videos/{playlist_name}', [PlaylistController::class, 'getVideosByPlaylist']);
