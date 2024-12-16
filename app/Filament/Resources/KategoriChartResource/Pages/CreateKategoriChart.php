<?php

namespace App\Filament\Resources\KategoriChartResource\Pages;

use App\Filament\Resources\KategoriChartResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKategoriChart extends CreateRecord
{
    protected static string $resource = KategoriChartResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
