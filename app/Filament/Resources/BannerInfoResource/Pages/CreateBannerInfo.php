<?php

namespace App\Filament\Resources\BannerInfoResource\Pages;

use App\Filament\Resources\BannerInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBannerInfo extends CreateRecord
{
    protected static string $resource = BannerInfoResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
