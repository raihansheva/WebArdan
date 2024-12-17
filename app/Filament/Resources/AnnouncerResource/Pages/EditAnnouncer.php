<?php

namespace App\Filament\Resources\AnnouncerResource\Pages;

use App\Filament\Resources\AnnouncerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnnouncer extends EditRecord
{
    protected static string $resource = AnnouncerResource::class;

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
