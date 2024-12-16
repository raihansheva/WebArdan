<?php

namespace App\Filament\Resources\TagInfoResource\Pages;

use App\Filament\Resources\TagInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTagInfo extends CreateRecord
{
    protected static string $resource = TagInfoResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
