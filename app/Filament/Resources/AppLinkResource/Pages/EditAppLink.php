<?php

namespace App\Filament\Resources\AppLinkResource\Pages;

use App\Filament\Resources\AppLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAppLink extends EditRecord
{
    protected static string $resource = AppLinkResource::class;

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
