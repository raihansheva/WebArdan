<?php

use App\Http\Controllers\FeedInstagramController;
use App\Http\Controllers\GoogleAnalyticsControllers;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ProgramController;
use App\Models\Info;
use App\Models\Podcast;
use App\Services\GoogleAnalyticsService;
use App\Services\GoogleAnalyticsServices;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

// Route::get('/', function () {
//     return view('page.home');
// });

// Route::get('/home', function () {
//     return view('page.home');
// });
Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create('/')
            ->setPriority(1.0)
            ->setChangeFrequency('daily'))
        ->add(Url::create('/ardan-youtube')
            ->setPriority(0.7)
            ->setChangeFrequency('daily'))
        ->add(Url::create('/chart')
            ->setPriority(0.7)
            ->setChangeFrequency('daily'))
        ->add(Url::create('/info-news')
            ->setPriority(0.7)
            ->setChangeFrequency('daily'))
        ->add(Url::create('/chart')
            ->setPriority(0.7)
            ->setChangeFrequency('daily'))
        ->add(Url::create('/event')
            ->setPriority(0.8)
            ->setChangeFrequency('weekly'));
    $podcasts = Podcast::all();
    foreach ($podcasts as $podcast) {
        $sitemap->add(
            Url::create("/detail-podcast/{$podcast->slug}")
                ->setLastModificationDate($podcast->updated_at)
                ->setChangeFrequency('weekly')
                ->setPriority(0.7)
        );
    }

    $info = Info::all();
    foreach ($info as $dataInfo) {
        $sitemap->add(
            Url::create("/info-detail/{$dataInfo->slug}")
                ->setLastModificationDate($dataInfo->updated_at)
                ->setChangeFrequency('weekly')
                ->setPriority(0.7)
        );
    }
    return $sitemap->toResponse(request());
});

Route::get('/analytics-test', function (GoogleAnalyticsServices $analyticsService) {
    $data = $analyticsService->getWebsiteTraffic('30daysAgo', 'today');
    return response()->json($data);
});

Route::get('/get-realtime-analytics', [GoogleAnalyticsControllers::class, 'getGoogleAnalyticsData']);


Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'index']);
Route::get('/info-artis', [HomeController::class, 'artis']);
Route::get('/detail-info-artis/{slug}', [HomeController::class, 'detailInfoArtis']);

Route::get('/event', [HomeController::class, 'event']);
Route::get('/detail-event/{slug}', [HomeController::class, 'detailEvent']);

Route::get('/podcast', [HomeController::class, 'podcast']);

Route::get('/detail-podcast/{slug}', [HomeController::class, 'detailpodcast']);

Route::get('/chart', [HomeController::class, 'chart']);

Route::get('/detail-program/{slug}', [HomeController::class, 'detailprogram']);

Route::get('/info-news', [HomeController::class, 'info']);
Route::get('/info-tag/{tag}', [HomeController::class, 'tagInfo']);
Route::get('/info-detail/{slug}', [HomeController::class, 'detailInfo']);

Route::get('/ardan-youtube', [HomeController::class, 'youtube']);

Route::get('/api/playlists', [PlaylistController::class, 'getPlaylists']);
Route::get('/api/videos/{playlist_name}', [PlaylistController::class, 'getVideosByPlaylist']);
Route::get('/api/instagram/feed/{id}', [FeedInstagramController::class, 'getInstagramFeed']);
Route::get('/podcast/{idP}/episode/{eps}/{direction}', [PlaylistController::class, 'getEpisode']);
Route::get('/podcast/details/{id}', [PlaylistController::class, 'showPodcastDetails']);
Route::get('/api/next-program-image', [ProgramController::class, 'getNextProgramImage']);
