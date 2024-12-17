<?php

namespace App\Filament\Resources\ArtisResource\Pages;

use App\Filament\Resources\ArtisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArtis extends EditRecord
{
    protected static string $resource = ArtisResource::class;

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
