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
        $client->setAuthConfig('C:\Users\LENOVO\Desktop\WebArdan\storage\app\analytics\service-account-credentials.json');
        $client->addScope('https://www.googleapis.com/auth/analytics.readonly');

        $this->analytics = new Google_Service_Analytics($client);
    }

    public function getWebsiteTraffic($startDate, $endDate)
    {
        $viewId = '376105671';

        return $this->analytics->data_ga->get(
            'ga:' . $viewId,
            $startDate,
            $endDate,
            'ga:sessions,ga:pageviews'
        );
    }
}
