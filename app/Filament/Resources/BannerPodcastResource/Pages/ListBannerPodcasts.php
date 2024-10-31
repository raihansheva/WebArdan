<?php

namespace App\Filament\Resources\BannerPodcastResource\Pages;

use App\Filament\Resources\BannerPodcastResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBannerPodcasts extends ListRecords
{
    protected static string $resource = BannerPodcastResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
