<?php

namespace App\Filament\Resources\CopyRightResource\Pages;

use App\Filament\Resources\CopyRightResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCopyRights extends ListRecords
{
    protected static string $resource = CopyRightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
