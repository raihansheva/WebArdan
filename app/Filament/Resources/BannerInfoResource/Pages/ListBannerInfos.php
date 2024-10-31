<?php

namespace App\Filament\Resources\BannerInfoResource\Pages;

use App\Filament\Resources\BannerInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBannerInfos extends ListRecords
{
    protected static string $resource = BannerInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
