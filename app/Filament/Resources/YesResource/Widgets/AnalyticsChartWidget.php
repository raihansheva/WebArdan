<?php

namespace App\Filament\Resources\YesResource\Widgets\AnalyticsChartWidget;

use App\Http\Controllers\GoogleAnalyticsControllers;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Log;

class AnalyticsChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Analitik Pengguna';
    protected static ?int $sort = 1; // Biar di bawah StatsOverview
    protected function getData(): array
    {
        $controller = new GoogleAnalyticsControllers();
        $response = $controller->getGoogleAnalyticsData();

        $data = json_decode($response->getContent(), true);

        Log::info('API Response:', ['data' => $data]);

        $dates = [];
        $activeUsers = [];
        $newUsers = [];

        if (is_array($data) && isset($data['rows'])) {
            foreach ($data['rows'] as $row) {
                $date = $row['dimensionValues'][0]['value']; 
                $activeUserCount = (int) $row['metricValues'][0]['value']; 
                $newUserCount = isset($row['metricValues'][3]) ? (int) $row['metricValues'][3]['value'] : 0;

                if ($activeUserCount > 0) { // Pastikan nilai tidak nol
                    $dates[] = $date;
                    $activeUsers[] = $activeUserCount;
                    $newUsers[] = $newUserCount;
                }
            }
        }

        // Urutkan data berdasarkan tanggal agar grafik naik
        array_multisort($dates, SORT_ASC, $activeUsers);

        return [
            'datasets' => [
                [
                    'label' => 'Pengguna Aktif',
                    'data' => $activeUsers,
                    'borderColor' => '#007bff',
                    'backgroundColor' => 'rgba(0, 123, 255, 0.2)',
                    'fill' => true,
                    'tension' => 0.4, // Membuat garis lebih halus
                ],
                // [
                //     'label' => 'Pengguna Baru',
                //     'data' => $newUsers,
                //     'borderColor' => '#28a745',
                //     'backgroundColor' => 'rgba(40, 167, 69, 0.2)',
                //     'fill' => true,
                //     'tension' => 0.4, 
                // ],
            ],
            'labels' => $dates,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getContainerClasses(): array
    {
        return ['w-3/4', 'mx-auto'];
    }
}
