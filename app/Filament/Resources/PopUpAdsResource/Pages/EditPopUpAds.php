<?php

namespace App\Filament\Resources\PopUpAdsResource\Pages;

use App\Filament\Resources\PopUpAdsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPopUpAds extends EditRecord
{
    protected static string $resource = PopUpAdsResource::class;

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
