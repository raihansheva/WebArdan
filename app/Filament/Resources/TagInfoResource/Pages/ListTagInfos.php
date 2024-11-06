<?php

namespace App\Filament\Resources\TagInfoResource\Pages;

use App\Filament\Resources\TagInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTagInfos extends ListRecords
{
    protected static string $resource = TagInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
