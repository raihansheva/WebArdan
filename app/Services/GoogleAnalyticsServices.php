<?php

namespace App\Services;

use Google\Client as Google_Client;
use Google\Service\Analytics as Google_Service_Analytics;

class GoogleAnalyticsServices
{
    protected $analytics;

    public function __construct()
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path(env('GOOGLE_ANALYTICS_KEY_PATH')));
        $client->addScope('https://www.googleapis.com/auth/analytics.readonly');

        $this->analytics = new Google_Service_Analytics($client);
    }

    public function getWebsiteTraffic($startDate, $endDate)
    {
        $viewId = env('GOOGLE_ANALYTICS_VIEW_ID');

        return $this->analytics->data_ga->get(
            'ga:' . $viewId,
            $startDate,
            $endDate,
            'ga:sessions,ga:pageviews'
        );
    }
}
