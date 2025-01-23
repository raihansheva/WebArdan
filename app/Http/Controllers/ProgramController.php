<?php

namespace App\Http\Controllers;

use App\Models\PopupAds;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
    public function getNextProgramImage()
    {
        // Set Locale ke Bahasa Indonesia
        Carbon::setLocale('id'); // Menggunakan Bahasa Indonesia

        // Ambil waktu sekarang dengan zona waktu Jakarta
        $currentTime = Carbon::now('Asia/Jakarta');

        // Ambil hari dalam format bahasa Indonesia
        $currentDay = $currentTime->locale('id')->isoFormat('dddd');

        // Query untuk mendapatkan program berikutnya
        $nextProgram = DB::table('schedules')
            ->join('programs', 'schedules.program_id', '=', 'programs.id')
            ->whereRaw('JSON_EXTRACT(schedules.hari, "$") LIKE ?', ['%"' . $currentDay . '"%']) // Cek keberadaan hari
            ->where('schedules.jam_mulai', '>', $currentTime->format('H:i:s')) // Program setelah jam sekarang
            ->orderBy('schedules.jam_mulai', 'asc') // Urutkan berdasarkan jam mulai terdekat
            ->select('programs.thumbnail_program', 'programs.judul_program', 'schedules.jam_mulai') // Ambil kolom yang diperlukan
            ->first();



        // Jika tidak ada program berikutnya, kirim gambar placeholder
        if (!$nextProgram) {
            return response()->json([
                'image' => asset('storage/default-placeholder.png'),
                'judul_program' => '-',
                'jam_mulai' => '-'
            ], 200);
        }

        return response()->json([
            'image' => asset('storage/' . $nextProgram->thumbnail_program),
            'judul_program' => $nextProgram->judul_program,
            'jam_mulai' => $nextProgram->jam_mulai
        ], 200);
    }


    public function getNextThumbnailImage()
    {
        // Set Locale ke Bahasa Indonesia
        Carbon::setLocale('id');

        // Ambil waktu sekarang dengan zona waktu Jakarta
        $currentTime = Carbon::now('Asia/Jakarta');

        // Ambil hari dalam format bahasa Indonesia
        $currentDay = $currentTime->locale('id')->isoFormat('dddd');

        // Query untuk mendapatkan program yang sedang berlangsung atau berikutnya
        $currentOrNextProgram = DB::table('schedules')
            ->join('programs', 'schedules.program_id', '=', 'programs.id')
            ->whereRaw('JSON_EXTRACT(schedules.hari, "$") LIKE ?', ['%"' . $currentDay . '"%']) // Cocokkan hari
            ->where('schedules.jam_mulai', '<=', $currentTime->format('H:i:s')) // Jam mulai <= waktu sekarang
            ->orderBy('schedules.jam_mulai', 'desc') // Urutkan program yang sudah mulai
            ->select('programs.thumbnail_program', 'programs.judul_program', 'schedules.jam_mulai')
            ->first();

        // Jika tidak ada program yang sesuai, kirim placeholder
        if (!$currentOrNextProgram) {
            return response()->json([
                'image' => asset('storage/default-placeholder.png'),
                'judul_program' => '-',
                'jam_mulai' => '-',
            ], 200);
        }

        // Jika program ditemukan, gunakan thumbnail program tersebut
        return response()->json([
            'image' => asset('storage/' . $currentOrNextProgram->thumbnail_program),
            'judul_program' => $currentOrNextProgram->judul_program,
            'jam_mulai' => $currentOrNextProgram->jam_mulai,
        ], 200);
    }


    public function getPopup()
    {
        $currentDate = now()->toDateString();
        $currentTime = now()->toTimeString();

        $popup = PopupAds::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->where(function ($query) use ($currentDate, $currentTime) {
                $query->where(function ($subQuery) use ($currentTime) {
                    $subQuery->where('end_time', '>=', $currentTime);
                })->orWhere(function ($subQuery) use ($currentDate) {
                    $subQuery->where('end_date', '>', $currentDate);
                });
            })
            ->first();

        return response()->json($popup);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
