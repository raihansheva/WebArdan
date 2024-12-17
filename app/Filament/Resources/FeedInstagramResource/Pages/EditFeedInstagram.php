<?php

namespace App\Filament\Resources\FeedInstagramResource\Pages;

use App\Filament\Resources\FeedInstagramResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFeedInstagram extends EditRecord
{
    protected static string $resource = FeedInstagramResource::class;

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
