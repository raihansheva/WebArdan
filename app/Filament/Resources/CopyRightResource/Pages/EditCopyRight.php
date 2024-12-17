<?php

namespace App\Filament\Resources\CopyRightResource\Pages;

use App\Filament\Resources\CopyRightResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCopyRight extends EditRecord
{
    protected static string $resource = CopyRightResource::class;

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
