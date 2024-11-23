<?php

namespace App\Filament\Resources\FeedInstagramResource\Pages;

use App\Filament\Resources\FeedInstagramResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeedInstagrams extends ListRecords
{
    protected static string $resource = FeedInstagramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
