<?php

namespace App\Http\Controllers;

use Exception;
use Google\Client as Google_Client;
use Google\Service\Analytics as Google_Service_Analytics;
use Illuminate\Http\Request;

class GoogleAnalyticsControllers extends Controller
{
    public function getGoogleAnalyticsData()
    {

        $client = new Google_Client();
        $client->setAuthConfig(storage_path('app/google-analytics-credentials.json')); // Path ke file kredensial
        $client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);

        $analytics = new Google_Service_Analytics($client);
        $response = $analytics->data_realtime->get(
            'ga:YOUR_VIEW_ID', // Ganti dengan view ID yang sesuai
            'rt:activeUsers'
        );

        // Mengembalikan data yang didapat dalam bentuk JSON
        return response()->json([
            'active_users' => $response->getRows()[0][0] ?? 0, // Ambil jumlah pengguna aktif
        ]);
    }
}
