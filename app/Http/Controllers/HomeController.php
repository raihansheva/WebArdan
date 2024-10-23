<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Info;
use App\Models\Event;
use App\Models\Banner;
use App\Models\Program;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banner = Banner::all();
        $program = Program::all();

        // Ambil event dengan status 'soon'
        $event_soon = Event::where('status', 'soon')->get();

        // Ambil event dengan status 'upcoming' dan batasi hanya 2 data
        $event_upcoming = Event::where('status', 'upcoming')->limit(2)->get();
        $info = Info::all();
        $topInfo = Info::where('top_news', true)->limit(5)->get();

        // Kirim semua data ke view
        return view('page.home', [
            'banner' => $banner,
            'program' => $program,
            'event_soon' => $event_soon,
            'event_upcoming' => $event_upcoming,
            'info' => $info,
            'top_info' => $topInfo
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
