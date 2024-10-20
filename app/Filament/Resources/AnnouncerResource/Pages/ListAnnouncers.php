<?php

namespace App\Filament\Resources\AnnouncerResource\Pages;

use App\Filament\Resources\AnnouncerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnnouncers extends ListRecords
{
    protected static string $resource = AnnouncerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
