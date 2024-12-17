<?php

namespace App\Filament\Resources\ChartResource\Pages;

use App\Filament\Resources\ChartResource;
use App\Models\Chart;
use Filament\Resources\Pages\EditRecord;

class EditChart extends EditRecord
{
    protected static string $resource = ChartResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Ambil semua lagu terkait kategori ini
        $songs = Chart::where('kategori_id', $data['kategori_id'])
            ->get(['name', 'link_audio'])
            ->toArray();

        // Tambahkan ke data form untuk repeater
        $data['songs'] = $songs;

        return $data;
    }

    protected function handleRecord(array $data): void
    {
        // Update semua lagu terkait kategori
        Chart::where('kategori_id', $data['kategori_id'])->delete();

        foreach ($data['songs'] as $song) {
            Chart::create([
                'kategori_id' => $data['kategori_id'],
                'name' => $song['name'],
                'link_audio' => $song['link_audio'],
            ]);
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
