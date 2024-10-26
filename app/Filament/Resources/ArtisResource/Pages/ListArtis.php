<?php

namespace App\Filament\Resources\ArtisResource\Pages;

use App\Filament\Resources\ArtisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArtis extends ListRecords
{
    protected static string $resource = ArtisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
