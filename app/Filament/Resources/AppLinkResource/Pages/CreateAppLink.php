<?php

namespace App\Filament\Resources\AppLinkResource\Pages;

use App\Filament\Resources\AppLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAppLink extends CreateRecord
{
    protected static string $resource = AppLinkResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
