<?php

namespace App\Http\Controllers;

use App\Models\Youtube;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */


      // Mengambil semua playlist
    // Mengambil daftar nama playlist unik
     // Mengambil daftar playlist unik
     public function getPlaylists()
     {
         $playlists = Youtube::select('link_youtube')->distinct()->get();
         return response()->json($playlists);
     }
 
     // Mengambil video berdasarkan playlist yang dipilih
     public function getVideosByPlaylist($playlist_name)
     {
         $videos = Youtube::where('link_youtube', $playlist_name)->get();
         return response()->json($videos);
     }

    public function index()
    {
        //
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
