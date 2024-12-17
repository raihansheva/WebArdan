<?php

namespace App\Filament\Resources\TagInfoResource\Pages;

use App\Filament\Resources\TagInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTagInfo extends EditRecord
{
    protected static string $resource = TagInfoResource::class;

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
