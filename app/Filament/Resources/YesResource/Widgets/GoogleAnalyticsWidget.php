<?php

namespace App\Filament\Resources\YesResource\Widgets;

use Filament\Widgets\ChartWidget;

class GoogleAnalyticsWidget extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static string $view = 'filament.widgets.google-analytics-widget';
    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
