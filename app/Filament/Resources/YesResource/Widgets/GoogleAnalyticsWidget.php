<?php

namespace App\Filament\Resources\YesResource\Widgets;

use Filament\Widgets\Widget;
use App\Http\Controllers\GoogleAnalyticsControllers;
use Illuminate\Support\Facades\Log;

class AnalyticsWidget extends Widget
{
    protected static string $view = 'filament.widgets.google-analytics-widget';
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 1;
    // Tambahkan polling Livewire agar refresh otomatis
    protected static bool $isLazy = false;
    protected static int $refreshInterval = 5000; // Refresh tiap 5 detik

    public function getViewData(): array
    {
        try {
            $controller = new GoogleAnalyticsControllers();
            $response = $controller->getGoogleAnalyticsData();

            Log::info('Google Analytics Response:', ['response' => $response]);

            if (empty($response)) {
                Log::error('Google Analytics response kosong atau null');
                return ['activeUsers' => 0];
            }

            $jsonStartPos = strpos($response, '{');
            if ($jsonStartPos === false) {
                Log::error('Tidak menemukan JSON dalam response API');
                return ['activeUsers' => 0];
            }
            
            $cleanJson = substr($response, $jsonStartPos);
            $data = json_decode($cleanJson, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('Google Analytics response bukan JSON valid: ' . json_last_error_msg());
                return ['activeUsers' => 0];
            }

            Log::info('Parsed Google Analytics Data:', ['data' => $data]);

            $activeUsers = $data['rows'][0]['metricValues'][0]['value'] ?? 0;
            $eventCount = $data['rows'][1]['metricValues'][1]['value'] ?? 0;
            $screenPageviews = $data['rows'][2]['metricValues'][2]['value'] ?? 0;

        } catch (\Exception $e) {
            Log::error('Error mengambil data Google Analytics: ' . $e->getMessage());
            $activeUsers = 0;
        }

        return [
            'activeUsers' => (int) $activeUsers,
            'eventCount' => (int) $eventCount,
            'screenPageviews' => (int) $screenPageviews,
        ];
    }
}
