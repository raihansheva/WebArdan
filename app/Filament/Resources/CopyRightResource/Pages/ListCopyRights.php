<?php

namespace App\Filament\Resources\CopyRightResource\Pages;

use App\Filament\Resources\CopyRightResource;
use App\Models\CopyRight;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCopyRights extends ListRecords
{
    protected static string $resource = CopyRightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected $listeners = ['refreshTable' => '$refresh']; // Listener untuk menyegarkan tabel

    public function getTableRecordsQuery()
    {
        return CopyRight::query();
    }
}
