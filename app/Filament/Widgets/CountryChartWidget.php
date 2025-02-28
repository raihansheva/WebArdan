<?php

namespace App\Filament\Widgets;

use App\Http\Controllers\GoogleAnalyticsControllers;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Log;

class CountryChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Top 10 Negara Pengunjung';
    protected static ?int $sort = 3; 
    
    protected function getData(): array
    {
        $controller = new GoogleAnalyticsControllers();
        $response = $controller->getAnalyticsDataByCountry();

        $data = json_decode($response->getContent(), true);

        Log::info('API Response:', ['data' => $data]);

        $countries = [];
        $activeUsers = [];

        if (is_array($data) && isset($data['rows'])) {
            foreach ($data['rows'] as $row) {
                $country = $row['dimensionValues'][0]['value']; 
                $userCount = (int) $row['metricValues'][0]['value']; 

                if ($userCount > 0) { 
                    $countries[] = $country;
                    $activeUsers[] = $userCount;
                }
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pengunjung',
                    'data' => $activeUsers,
                    'backgroundColor' => '#007bff',
                ],
            ],
            'labels' => $countries,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
