<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Info;
use App\Models\Event;
use App\Models\Banner;
use App\Models\Podcast;
use App\Models\Program;
use App\Models\Youtube;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banner = Banner::all();
        $program = Program::all();

        $event_soon = Event::where('status', 'soon')->get();

        $event_upcoming = Event::where('status', 'upcoming')->limit(2)->get();
        $info = Info::all();
        $topInfo = Info::where('top_news', true)->limit(5)->get();

        $podcast = Podcast::all();

        $playlist = Youtube::first();
        $apiKey = env('YOUTUBE_API_KEY');
        $playlistId = $playlist->link_youtube;

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
            'program' => $program,
            'event_soon' => $event_soon,
            'event_upcoming' => $event_upcoming,
            'info' => $info,
            'top_info' => $topInfo,
            'podcast' => $podcast,
            'videos' => $videos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
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
