<?php

namespace App\Filament\Resources\BannerPodcastResource\Pages;

use App\Filament\Resources\BannerPodcastResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBannerPodcast extends CreateRecord
{
    protected static string $resource = BannerPodcastResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
