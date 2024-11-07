<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
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

    public function getEpisode($idP, $eps, $direction)
    {
        // Debug untuk mengecek parameter
        // dd($idP, $eps, $direction);

        // Validasi jika arah (direction) tidak valid
        if (!in_array($direction, ['next', 'previous'])) {
            return response()->json(['error' => 'Invalid direction'], 400);
        }

        // Tentukan episode berdasarkan direction
        if ($direction === 'next') {
            // Episode berikutnya
            $episode = Podcast::where('podcast_id', $idP)
                ->where('episode_number', $eps) // Episode dengan nomor lebih besar
                ->orderBy('episode_number', 'asc') // Urutkan berdasarkan episode_number secara ascending
                ->first(); // Ambil episode pertama setelah episode yang diberikan
        } elseif ($direction === 'previous') {
            // Episode sebelumnya
            $episode = Podcast::where('podcast_id', $idP)
                ->where('episode_number', $eps) // Episode dengan nomor lebih kecil
                ->orderBy('episode_number', 'desc') // Urutkan berdasarkan episode_number secara descending
                ->first(); // Ambil episode pertama sebelumnya
        } 

        // Cek apakah episode ditemukan
        // dd($episode); // Untuk memastikan apakah episode ditemukan atau tidak

        // Jika episode tidak ditemukan
        if (!$episode) {
            return response()->json(['error' => 'Episode not found'], 404);
        }

        // Kembalikan episode dalam format JSON
        return response()->json($episode);
    }

    public function showPodcastDetails($id)
    {
        // Mengambil data podcast berdasarkan ID
        $podcast = Podcast::find($id);

        if ($podcast) {
            // Jika podcast ditemukan, kembalikan data dalam bentuk JSON
            return response()->json($podcast);
        } else {
            // Jika podcast tidak ditemukan, kembalikan error
            return response()->json(['error' => 'Podcast not found'], 404);
        }
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
