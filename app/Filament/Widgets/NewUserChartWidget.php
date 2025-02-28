<?php

namespace App\Filament\Widgets;

use App\Http\Controllers\GoogleAnalyticsControllers;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Log;

class NewUserChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Pengguna Baru 30 Hari Terakhir';
    protected static ?int $sort = 2; // Biar di bawah StatsOverview
    protected function getData(): array
    {
        $response = app(GoogleAnalyticsControllers::class)->getAnalyticsDataNewsUsers();
        $data = json_decode($response->getContent(), true);

        // Log untuk debugging
        Log::info('API Response:', ['data' => $data]);

        $dates = [];
        $newUsers = [];

        if (is_array($data) && isset($data['rows'])) {
            foreach ($data['rows'] as $row) {
                $date = $row['dimensionValues'][0]['value']; // Format: YYYYMMDD
                $newUserCount = (int) $row['metricValues'][0]['value'];

                if ($newUserCount > 0) { // Pastikan nilai tidak nol
                    $dates[] = date('Y-m-d', strtotime($date)); // Format tanggal lebih rapi
                    $newUsers[] = $newUserCount;
                }
            }
        }

        // Urutkan data berdasarkan tanggal agar grafik naik
        array_multisort($dates, SORT_ASC, $newUsers);

        return [
            'datasets' => [
                [
                    'label' => 'Pengguna Baru',
                    'data' => $newUsers,
                    'borderColor' => '#EB5B00',
                    'backgroundColor' => '#eb5a005b',
                    'fill' => true,
                    'tension' => 0.4, // Membuat garis lebih halus
                ],
            ],
            'labels' => $dates,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
