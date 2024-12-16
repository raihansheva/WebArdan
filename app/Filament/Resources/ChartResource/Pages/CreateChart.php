<?php

namespace App\Filament\Resources\ChartResource\Pages;

use App\Filament\Resources\ChartResource;
use App\Models\Chart;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateChart extends CreateRecord
{
    protected static string $resource = ChartResource::class;

    protected function handleRecordCreation(array $data): Chart
    {
        // Ambil kategori_id dari form
        $kategoriId = $data['kategori_id'];

        // Simpan data repeater (lagu)
        $charts = [];
        foreach ($data['songs'] as $song) {
            $charts[] = Chart::create([
                'kategori_id' => $kategoriId,
                'name' => $song['name'],
                'link_audio' => $song['link_audio'],
            ]);
        }

        // Kembalikan record pertama untuk rute edit
        return $charts[0];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
