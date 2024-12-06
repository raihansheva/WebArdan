<?php

namespace App\Http\Controllers;

use App\Models\TagInfo;
use Carbon\Carbon;
use App\Models\Info;
use App\Models\Artis;
use App\Models\Event;
use App\Models\Banner;
use App\Models\Podcast;
use App\Models\Program;
use App\Models\Youtube;
use App\Models\Kategori;
use App\Models\Schedule;
use App\Models\Announcer;
use App\Models\Streaming;
use App\Models\BannerInfo;
use Illuminate\Http\Request;
use App\Models\BannerPodcast;
use App\Models\BannerYoutube;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banner = Banner::all();

        $stream = Streaming::where('status', 'streaming')->first();
        $streamUpcoming = Streaming::where('status', 'upcoming')->limit(1)->get();

        $program = Program::all();

        $event_soon = Event::where('status', 'soon')->get();
        $event_upcoming = Event::where('status', 'upcoming')->limit(2)->get();

        // $taginfo = TagInfo::with('info')->get();
        $Info = Info::all();
        $topInfo = Info::where('top_news', true)->limit(3)->get();
        $TrendingInfo = Info::where('trending', true)->limit(5)->get();

        $announcer = Announcer::all();

        $podcast = Podcast::take(4)->get();
        $Kategori = Kategori::with('charts')->get();

        $schedule = Schedule::with('program')->get();

        $artis = Artis::all()->take(3);
        
        // foreach ($artis as $berita) {
        //     // Tentukan status publish langsung berdasarkan kondisi
        //     if ($berita->publish_sekarang) {
        //         $berita->publish_status = 'Publish Sekarang';
        //     } elseif ($berita->tanggal_publikasi && $berita->tanggal_publikasi >= now()) {
        //         $berita->publish_status = 'Jadwal Publish: ' . $berita->tanggal_publikasi->format('d M Y, H:i');
        //     } else {
        //         $berita->publish_status = 'Diterbitkan';
        //     }
        // }

        $playlist = Youtube::first();
        $apiKey = env('YOUTUBE_API_KEY');
        $playlistId = $playlist->link_youtube;
        // dd($topInfo);
        // Panggil YouTube API untuk mendapatkan video dari playlist
        $response = Http::get('https://www.googleapis.com/youtube/v3/playlistItems', [
            'part' => 'snippet',
            'maxResults' => 3,
            'playlistId' => $playlistId,
            'key' => $apiKey,
        ]);


        //  Buat ngcek kalo ada error
        // if ($response->successful()) {
        //     $videos = $response->json();
        //     dd($videos); // Tampilkan semua data yang diterima
        // } else {
        //     dd($response->json()); // Tampilkan error jika ada
        // }
        // --------------------------


        $videos = $response->json()['items'];

        // Kirim semua data ke view
        return view('page.home', [
            'banner' => $banner,
            'stream' => $stream,
            'streamUpcoming' => $streamUpcoming,
            'program' => $program,
            'event_soon' => $event_soon,
            'event_upcoming' => $event_upcoming,
            'info' => $Info,
            // 'taginfo' => $taginfo,
            'top_info' => $topInfo,
            'trending_info' => $TrendingInfo,
            'podcast' => $podcast,
            'videos' => $videos,
            'announcer' => $announcer,
            'kategori' => $Kategori,
            'schedule' => $schedule,
            'artis' => $artis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function event()
    {

        $program = Program::all()->take(4);
        $stream = Streaming::where('status', 'streaming')->first();
        $event_soon = Event::where('status', 'soon')->get();
        $event_upcoming = Event::where('status', 'upcoming')->limit(2)->get();

        return view('page.event', [
            'program' => $program,
            'stream' => $stream,
            'event_soon' => $event_soon,
            'event_upcoming' => $event_upcoming,
        ]);
    }

    public function podcast()
    {
        $bannerP = BannerPodcast::all();
        $podcast = Podcast::all();
        $playlist = Youtube::first();
        $topInfo = Info::where('top_news', true)->limit(5)->get();
        $apiKey = env('YOUTUBE_API_KEY');
        $playlistId = $playlist->link_youtube;
        $stream = Streaming::where('status', 'streaming')->first();

        // Panggil YouTube API untuk mendapatkan video dari playlist
        $response = Http::get('https://www.googleapis.com/youtube/v3/playlistItems', [
            'part' => 'snippet',
            'maxResults' => 3,
            'playlistId' => $playlistId,
            'key' => $apiKey,
        ]);


        //  Buat ngcek kalo ada error
        // if ($response->successful()) {
        //     $videos = $response->json();
        //     dd($videos); // Tampilkan semua data yang diterima
        // } else {
        //     dd($response->json()); // Tampilkan error jika ada
        // }
        // --------------------------


        $videos = $response->json()['items'];

        return view('page.podcast', [
            'bannerP' => $bannerP,
            'podcast' => $podcast,
            'videos' => $videos,
            'topInfo' => $topInfo,
            'stream' => $stream
        ]);
    }

    public function detailpodcast($slug)
    {
        // Cari podcast berdasarkan slug
        $detailpodcast = Podcast::where('slug', $slug)->firstOrFail();

        $idPodcast = $detailpodcast->id;

        $epsgroup = Podcast::where('podcast_id', $idPodcast)->skip(1)->take(10)->get();

        $allpodcast = Podcast::all();

        $topInfo = Info::all()->take(5);

        $stream = Streaming::where('status', 'streaming')->first();
        // dd($epsgroup);
        $playlist = Youtube::first();

        $apiKey = env('YOUTUBE_API_KEY');
        $playlistId = $playlist->link_youtube;

        // Panggil YouTube API untuk mendapatkan video dari playlist
        $response = Http::get('https://www.googleapis.com/youtube/v3/playlistItems', [
            'part' => 'snippet',
            'maxResults' => 5,
            'playlistId' => $playlistId,
            'key' => $apiKey,
        ]);


        //  Buat ngcek kalo ada error
        // if ($response->successful()) {
        //     $videos = $response->json();
        //     dd($videos); // Tampilkan semua data yang diterima
        // } else {
        //     dd($response->json()); // Tampilkan error jika ada
        // }
        // --------------------------

        $videos = $response->json()['items'];

        // Tampilkan halaman detail dengan data podcast
        return view('page.detailPodcast', [
            'detail_podcast' => $detailpodcast,
            'eps_group' => $epsgroup,
            'all_podcast' => $allpodcast,
            'top_info' => $topInfo,
            'videos' => $videos,
            'stream' => $stream,
        ]);
    }


    public function chart()
    {
        $Kategori = Kategori::with('charts')->get();

        $topInfo = Info::where('top_news', true)->limit(5)->get();

        $stream = Streaming::where('status', 'streaming')->first();

        return view('page.chart', [
            'kategori' => $Kategori,
            'top_info' => $topInfo,
            'stream' => $stream,
        ]);
    }


    public function info()
    {
        $info = Info::all();
        // $taginfo = TagInfo::with('info')->get();
        $topInfo = Info::where('top_news', true)->limit(5)->get();
        $event_upcoming = Event::where('status', 'upcoming')->limit(2)->get();
        $artis = Artis::all();
        $bannerI = BannerInfo::all();
        $stream = Streaming::where('status', 'streaming')->first();
        // $time = Carbon::now('UTC')->toDateString();
        // dd($time);
        return view('page.infoNews', [
            'bannerInfo' => $bannerI,
            'info' => $info,
            // 'taginfo' => $taginfo,
            'top_info' => $topInfo,
            'event_upcoming' => $event_upcoming,
            'artis' => $artis,
            'stream' => $stream
        ]);
    }

    public function tagInfo($tag)
    {
        $info = Info::whereHas('tagInfo', function ($query) use ($tag) {
            $query->where('nama_tag', $tag); // Filter berdasarkan nama_tag di tabel tag_infos
        })->with('tagInfo')->get();
        $taginfo = TagInfo::with('info')->get();;
        $topInfo = Info::where('top_news', true)->limit(5)->get();
        $event_upcoming = Event::where('status', 'upcoming')->limit(2)->get();
        $artis = Artis::all();
        $bannerI = BannerInfo::all();
        $stream = Streaming::where('status', 'streaming')->first();

        // dd($info);

        return view('page.detailTaginfo', [
            'bannerInfo' => $bannerI,
            'info' => $info,
            'taginfo' => $taginfo,
            'top_info' => $topInfo,
            'event_upcoming' => $event_upcoming,
            'artis' => $artis,
            'stream' => $stream
        ]);
    }

    public function detailInfo($slug)
    {
        $info = Info::where('slug', $slug)->first();
        // $taginfo = TagInfo::with('info')->get();
        // dd($info->tag_info);
        $topInfo = Info::where('top_news', true)->limit(5)->get();
        $TrendingInfo = Info::all();
        $event_upcoming = Event::where('status', 'upcoming')->limit(2)->get();
        $artis = Artis::all();
        $bannerI = BannerInfo::all();
        $stream = Streaming::where('status', 'streaming')->first();

        // dd($info);

        return view('page.detailInfo', [
            'bannerInfo' => $bannerI,
            'info' => $info,
            'trending_info' => $TrendingInfo,
            'top_info' => $topInfo,
            'event_upcoming' => $event_upcoming,
            'artis' => $artis,
            'stream' => $stream
        ]);
    }


    public function youtube()
    {
        $youtube = Youtube::all();
        $event_soon = Event::where('status', 'soon')->get();
        $event_upcoming = Event::where('status', 'upcoming')->limit(2)->get();
        $topInfo = Info::all()->take(5);
        $bannerYT = BannerYoutube::first();
        $stream = Streaming::where('status', 'streaming')->first();

        return view('page.youtube', [
            'bannerYT' => $bannerYT,
            'youtube' => $youtube,
            'event_soon' => $event_soon,
            'event_upcoming' => $event_upcoming,
            'top_info' => $topInfo,
            'stream' => $stream
        ]);
    }



    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
