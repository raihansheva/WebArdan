<?php

namespace App\Filament\Resources\KategoriChartResource\Pages;

use App\Filament\Resources\KategoriChartResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriCharts extends ListRecords
{
    protected static string $resource = KategoriChartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
