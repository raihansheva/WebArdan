<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Filament\Resources\YesResource\Widgets\AnalyticsWidget;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1; // Paling atas
    protected static bool $isLazy = false;
    protected static int $refreshInterval = 5000; // Refresh setiap 5 detik

    protected function getStats(): array
    {
        $analytics = app(AnalyticsWidget::class)->getViewData();

        return [
            Stat::make('Active Users', $analytics['activeUsers'])
                ->description('Jumlah user aktif saat ini')
                ->chart($this->generateRandomChartData($analytics['activeUsers'])) // Tambahkan chart di sini
                ->color('success'), // Warna hijau
        
            Stat::make('Event Count', $analytics['eventCount'])
                ->description('Jumlah event yang terjadi')
                ->chart($this->generateRandomChartData($analytics['eventCount'])) // Tambahkan chart di sini
                ->color('warning'), // Warna kuning
        
            Stat::make('Screen Page Views', $analytics['screenPageviews'])
                ->description('Jumlah tampilan halaman')
                ->chart($this->generateRandomChartData($analytics['screenPageviews'])) // Tambahkan chart di sini
                ->color('primary'), // Warna biru
        ];
    }

    private function generateRandomChartData(int $key): array
    {
        return [
            rand($key, 100), rand($key, 100), rand($key, 100), 
            rand($key, 100), rand($key, 100), rand($key, 100)
        ];
    }
}