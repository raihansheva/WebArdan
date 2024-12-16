<?php

namespace App\Filament\Resources\BannerYoutubeResource\Pages;

use App\Filament\Resources\BannerYoutubeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBannerYoutube extends CreateRecord
{
    protected static string $resource = BannerYoutubeResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
