<?php

namespace App\Filament\Resources\YesResource\Widgets;

use App\Http\Controllers\GoogleAnalyticsControllers;
use Filament\Widgets\ChartWidget;
use Google_Client;
use Google_Service_Analytics;

class GoogleAnalyticsWidget extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static string $view = 'filament.widgets.google-analytics-widget';


    protected function getData(): array
    {
        // $response = (new GoogleAnalyticsControllers())->getGoogleAnalyticsData();
        // return $response->getData();
        return [];
    }

    // public function getData(): array
    // {
    //     $client = new Google_Client();
    //     $client->setAuthConfig(storage_path('app/google-analytics-credentials.json'));
    //     $client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);

    //     $analytics = new Google_Service_Analytics($client);
    //     $response = $analytics->data_realtime->get(
    //         'ga:YOUR_VIEW_ID', // Ganti dengan view ID yang sesuai
    //         'rt:activeUsers'
    //     );

    //     return [
    //         'active_users' => $response->getRows()[0][0] ?? 0, // Ambil jumlah pengguna aktif
    //     ];
    // }



    protected function getType(): string
    {
        return 'line';
    }
}
