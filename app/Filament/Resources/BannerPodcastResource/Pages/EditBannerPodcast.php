<?php

namespace App\Filament\Resources\BannerPodcastResource\Pages;

use App\Filament\Resources\BannerPodcastResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBannerPodcast extends EditRecord
{
    protected static string $resource = BannerPodcastResource::class;

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
