<?php

use App\Http\Controllers\FeedInstagramController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaylistController;
use Illuminate\Support\Facades\Route;

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
Route::get('/info-tag/{tag}', [HomeController::class, 'tagInfo']);

Route::get('/ardan-youtube', [HomeController::class, 'youtube']);

Route::get('/api/playlists', [PlaylistController::class, 'getPlaylists']);
Route::get('/api/videos/{playlist_name}', [PlaylistController::class, 'getVideosByPlaylist']);
Route::get('/api/instagram/feed/{id}', [FeedInstagramController::class, 'getInstagramFeed']);
Route::get('/podcast/{idP}/episode/{eps}/{direction}', [PlaylistController::class, 'getEpisode']);
Route::get('/podcast/details/{id}', [PlaylistController::class, 'showPodcastDetails']);
