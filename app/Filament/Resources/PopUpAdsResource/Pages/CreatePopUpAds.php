<?php

namespace App\Filament\Resources\PopUpAdsResource\Pages;

use App\Filament\Resources\PopUpAdsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePopUpAds extends CreateRecord
{
    protected static string $resource = PopUpAdsResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
