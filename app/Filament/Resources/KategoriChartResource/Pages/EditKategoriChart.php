<?php

namespace App\Filament\Resources\KategoriChartResource\Pages;

use App\Filament\Resources\KategoriChartResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriChart extends EditRecord
{
    protected static string $resource = KategoriChartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
