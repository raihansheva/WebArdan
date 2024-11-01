<?php

namespace App\Filament\Resources\AppLinkResource\Pages;

use App\Filament\Resources\AppLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAppLinks extends ListRecords
{
    protected static string $resource = AppLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
