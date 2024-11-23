<?php

namespace App\Http\Controllers;

use App\Models\FeedInstagram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FeedInstagramController extends Controller
{

    public function getInstagramFeed($id)
    {
        // Ambil link Instagram dari database berdasarkan ID
        $feed = FeedInstagram::find($id);
        
        if (!$feed) {
            return response()->json(['message' => 'Link Instagram tidak ditemukan'], 404);
        }

        // Ambil username Instagram dari link (misalnya untuk https://www.instagram.com/username/)
        $username = $this->extractUsernameFromLink($feed->instagram_link);

        // Ambil data feed Instagram menggunakan Graph API
        $accessToken = 'your_access_token'; // Masukkan token akses Anda di sini
        $url = "https://graph.instagram.com/v12.0/{$username}/media?fields=id,caption,media_type,media_url,timestamp&access_token={$accessToken}";

        // Memanggil API Instagram Graph untuk mendapatkan data feed
        $response = Http::get($url);

        if ($response->successful()) {
            $feeds = $response->json()['data'];

            // Return data feed sebagai JSON
            return response()->json($feeds);
        }

        return response()->json(['message' => 'Gagal mengambil data dari Instagram'], 400);
    }

    // Fungsi untuk mengekstrak username dari link Instagram
    private function extractUsernameFromLink($link)
    {
        $parsedUrl = parse_url($link);
        $path = trim($parsedUrl['path'], '/'); // Mengambil bagian path setelah domain (misal: 'username')

        return $path; // Mengembalikan username (misal: 'username')
    }
}
