<?php

namespace App\Filament\Resources\PopUpAdsResource\Pages;

use App\Filament\Resources\PopUpAdsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPopUpAds extends ListRecords
{
    protected static string $resource = PopUpAdsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
