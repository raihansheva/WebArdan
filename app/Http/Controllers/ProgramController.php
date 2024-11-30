<?php

namespace App\Http\Controllers;

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
            ->where('schedules.hari', $currentDay) // Cocokkan hari dalam bahasa Indonesia
            ->where('schedules.jam_mulai', '>', $currentTime->format('H:i:s')) // Program setelah jam sekarang
            ->orderBy('schedules.jam_mulai', 'asc') // Urutkan berdasarkan jam mulai terdekat
            ->select('programs.image_program') // Hanya ambil kolom gambar
            ->first();

        // Jika tidak ada program berikutnya, kirim gambar placeholder
        if (!$nextProgram) {
            return response()->json(['image' => asset('storage/default-placeholder.png')], 200);
        }
    
        // Kirim URL gambar program berikutnya
        return response()->json(['image' => asset('storage/' . $nextProgram->image_program)], 200);
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
