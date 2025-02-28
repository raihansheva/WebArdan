<?php

namespace App\Http\Controllers;

use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\OrderBy;
use Illuminate\Http\Request;

class GoogleAnalyticsControllers extends Controller
{
    public function getGoogleAnalyticsData()
    {
        // Set kredensial secara aman
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . storage_path('app/analytics/service-account-credentials.json'));

        $client = new BetaAnalyticsDataClient();

        try {
            // Jalankan laporan real-time dengan metrik yang valid
            $response = $client->runRealtimeReport([
                'property' => 'properties/376105671', // Ganti dengan Property ID yang benar
                'dimensions' => [new Dimension(['name' => 'country'])], // Bisa diganti dengan dimensi lain
                'metrics' => [
                    new Metric(['name' => 'activeUsers']),
                    new Metric(['name' => 'eventCount']),
                    new Metric(['name' => 'screenPageViews'])
                ],
                'dateRanges' => [
                    ['startDate' => '30daysAgo', 'endDate' => 'today'], // Ambil data 30 hari terakhir
                ],
            ]);

            // Return response sebagai JSON
            return response()->json(json_decode($response->serializeToJsonString(), true));
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getAnalyticsDataNewsUsers()
    {
        // Set kredensial secara aman
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . storage_path('app/analytics/service-account-credentials.json'));

        $client = new BetaAnalyticsDataClient();

        try {
            // Jalankan laporan menggunakan GA4 Data API (bukan Realtime API)
            $response = $client->runReport([
                'property' => 'properties/376105671', // Ganti dengan Property ID kamu
                'dateRanges' => [
                    new DateRange(['start_date' => '30daysAgo', 'end_date' => 'today']), // Data 30 hari terakhir
                ],
                'dimensions' => [
                    new Dimension(['name' => 'date']), // Gunakan tanggal sebagai dimensi utama
                ],
                'metrics' => [
                    new Metric(['name' => 'newUsers']), // ✅ Bisa digunakan di GA4 Data API
                ],
            ]);

            // Ubah response menjadi array JSON
            return response()->json(json_decode($response->serializeToJsonString(), true));
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getAnalyticsDataByCountry()
    {
        // Set kredensial secara aman
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . storage_path('app/analytics/service-account-credentials.json'));

        $client = new BetaAnalyticsDataClient();

        try {
            // Jalankan laporan menggunakan GA4 Data API
            $response = $client->runReport([
                'property' => 'properties/376105671', // Ganti dengan Property ID kamu
                'dateRanges' => [
                    new DateRange(['start_date' => '30daysAgo', 'end_date' => 'today']), // Data 30 hari terakhir
                ],
                'dimensions' => [
                    new Dimension(['name' => 'country']), // Menggunakan negara sebagai dimensi
                ],
                'metrics' => [
                    new Metric(['name' => 'activeUsers']), // Menghitung jumlah pengguna aktif per negara
                ],
                'orderBys' => [
                    new OrderBy([
                        'desc' => true, // Urutkan berdasarkan jumlah pengguna terbanyak
                        'metric' => new OrderBy\MetricOrderBy(['metric_name' => 'activeUsers']),
                    ]),
                ],
                'limit' => 10, // Ambil 10 negara dengan pengunjung terbanyak
            ]);

            // Ubah response menjadi array JSON
            return response()->json(json_decode($response->serializeToJsonString(), true));
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
