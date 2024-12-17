<?php

namespace App\Filament\Resources\BannerYoutubeResource\Pages;

use App\Filament\Resources\BannerYoutubeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBannerYoutube extends EditRecord
{
    protected static string $resource = BannerYoutubeResource::class;

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
