<?php

namespace App\Filament\Resources\BannerYoutubeResource\Pages;

use App\Filament\Resources\BannerYoutubeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBannerYoutubes extends ListRecords
{
    protected static string $resource = BannerYoutubeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
