<?php

namespace App\Filament\Resources\BannerInfoResource\Pages;

use App\Filament\Resources\BannerInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBannerInfo extends EditRecord
{
    protected static string $resource = BannerInfoResource::class;

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
