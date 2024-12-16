<?php

namespace App\Filament\Resources\CopyRightResource\Pages;

use App\Filament\Resources\CopyRightResource;
use App\Models\CopyRight;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CreateCopyRight extends CreateRecord
{
    use WithFileUploads;

    protected static string $resource = CopyRightResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
