<?php

namespace App\Filament\Resources\AnnouncerResource\Pages;

use App\Filament\Resources\AnnouncerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnnouncer extends CreateRecord
{
    protected static string $resource = AnnouncerResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
