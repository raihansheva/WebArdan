<?php

namespace App\Filament\Resources\ArtisResource\Pages;

use App\Filament\Resources\ArtisResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateArtis extends CreateRecord
{
    protected static string $resource = ArtisResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
