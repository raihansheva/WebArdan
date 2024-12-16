<?php

namespace App\Filament\Resources\FeedInstagramResource\Pages;

use App\Filament\Resources\FeedInstagramResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFeedInstagram extends CreateRecord
{
    protected static string $resource = FeedInstagramResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
