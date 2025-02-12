<?php

namespace App\Filament\Resources\ChartResource\Pages;

use App\Filament\Resources\ChartResource;
use App\Models\Chart;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class EditChart extends EditRecord
{
    protected static string $resource = ChartResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        Log::info('Mutate Data Sebelum Fill', $data);

        $songs = Chart::where('kategori_id', $data['kategori_id'])
            ->get(['name', 'link_audio'])
            ->toArray();

        Log::info('Songs yang ditemukan:', $songs);

        // Simpan lagu lama ke dalam session atau variabel global agar bisa dipakai nanti

        $data['songs'] = $songs ?? [];

        session(['old_songs' => $songs]);

        return $data;
    }


    // protected function handleRecordUpdate(\Illuminate\Database\Eloquent\Model $record, array $data): \Illuminate\Database\Eloquent\Model
    // {
    //     Log::info('📥 Data diterima di handleRecordUpdate', $data);

    //     // Ambil lagu lama dari session
    //     $oldSongs = session('old_songs', []);

    //     // Cek apakah session ada
    //     if (empty($oldSongs)) {
    //         Log::warning('⚠ Session old_songs kosong! Pastikan session diisi di mutateFormDataBeforeFill.');
    //     } else {
    //         Log::info('📜 Daftar lagu lama dari session:', $oldSongs);
    //     }


    //     return DB::transaction(function () use ($record, $data, $oldSongs) {
    //         Log::info('info data yang diterima dua kali : ' , $data);
    //         // Update kategori_id jika berubah
    //         $record->update(['kategori_id' => $data['kategori_id']]);
    //         $oldname = array_column($oldSongs, 'name');
    //         Log::warning('data session ada :', $oldname);

    //         // Pastikan 'songs' ada dan merupakan array
    //         if (!isset($data['songs']) || !is_array($data['songs'])) {
    //             Log::warning('Data songs kosong atau tidak valid');
    //             return $record;
    //         }

    //         foreach ($data['songs'] as $song) {
    //             if (empty($song['name'])) {
    //                 Log::warning('Sebuah lagu tidak memiliki nama, melewati...');
    //                 continue;
    //             }

    //             Log::info('🔍 Mencari lagu dengan kategori_id:', ['kategori_id' => $data['kategori_id'], 'name' => $song['name'], 'id' => $song['id'] ?? 'null']);

    //             $existingSong = Chart::where('kategori_id', $data['kategori_id'])->where('name', $oldname)->first();

    //             if ($existingSong) {
    //                 Log::info('✅ Lagu ditemukan:', ['id' => $existingSong->id, 'name' => $existingSong->name]);
    //             } else {
    //                 Log::warning('❌ Lagu tidak ditemukan di database.');
    //             }

    //             if ($existingSong) {
    //                 // Jika sudah ada, update saja
    //                 $updateChart = Chart::where('id' ,$existingSong->id );
    //                 $updateChart->update([
    //                     'name' => $song['name'] ?? $existingSong->name,
    //                     'link_audio' => $song['link_audio'] ?? $existingSong->link_audio,
    //                 ]);
    //             } else {
    //                 // Tidak perlu menambah jika hanya edit
    //                 Log::info('Lagu tidak ditemukan, melewati penambahan data baru.');
    //             }
    //         }

    //         Log::info('Data setelah update', ['kategori_id' => $data['kategori_id']]);

    //         return $record->refresh();
    //     });
    // }
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update([
            'kategori_id' => $data['kategori_id']
        ]);

        $existingChartIds = collect($data['songs'])->pluck('id')->filter()->toArray();

        // Hapus lagu yang tidak ada di input baru
        Chart::where('kategori_id', $record->kategori_id)
            ->whereNotIn('id', $existingChartIds)
            ->delete();

        foreach ($data['songs'] as $songData) {
            $linkAudio = $songData['link_audio'] ?? null;
            if (is_array($linkAudio) && !empty($linkAudio)) {
                $linkAudio = reset($linkAudio); // Ambil elemen pertama jika array
            }

            if (!empty($songData['id'])) {
                // Update jika ID sudah ada
                $chartModel = Chart::find($songData['id']);
                if ($chartModel) {
                    $chartModel->update([
                        'name' => $songData['name'] ?? '',
                        'link_audio' => $linkAudio ?? '',
                        'kategori_id' => $data['kategori_id'],
                    ]);
                }
            } else {
                // Tambah baru jika tidak ada ID
                Chart::create([
                    'name' => $songData['name'] ?? '',
                    'link_audio' => $linkAudio ?? '',
                    'kategori_id' => $data['kategori_id'],
                ]);
            }
        }

        return $record;
    }





    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
