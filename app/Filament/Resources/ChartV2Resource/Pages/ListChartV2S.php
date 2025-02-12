<?php

namespace App\Filament\Resources\ChartV2Resource\Pages;

use App\Filament\Resources\ChartV2Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChartV2S extends ListRecords
{
    protected static string $resource = ChartV2Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
