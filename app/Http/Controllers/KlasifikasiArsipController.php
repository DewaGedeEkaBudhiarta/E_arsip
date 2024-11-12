<?php

namespace App\Http\Controllers;

use App\Models\KlasifikasiArsip;
use Illuminate\Http\Request;

class KlasifikasiArsipController extends Controller
{
    public function index()
    {
        // Fetch all records from the klasifikasi_arsip table
        $klasifikasiArsip = KlasifikasiArsip::all();
        
        // Debugging: Check if data is being fetched
        // dd($klasifikasiArsip);

        // Pass the data to the Blade view
        return view('informasi-arsip.index', compact('klasifikasiArsip'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fungsi' => 'required|string|max:255',
            'primer' => 'required|string|max:255',
            'kegiatan' => 'required|string|max:255',
            'sekunder' => 'required|string|max:255',
            'transaksi' => 'required|string|max:255',
            'tersier' => 'required|string|max:255',
            'indeks' => 'required|string|max:255',
        ]);

        KlasifikasiArsip::create([
            'Fungsi' => $request->fungsi,
            'Primer' => $request->primer,
            'Kegiatan' => $request->kegiatan,
            'Sekunder' => $request->sekunder,
            'Transaksi' => $request->transaksi,
            'Tersier' => $request->tersier,
            'Indeks' => $request->indeks,
        ]);

        return redirect()->route('informasi-arsip.index')->with('success', 'Klasifikasi Arsip berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $klasifikasiArsip = KlasifikasiArsip::findOrFail($id);
        $klasifikasiArsip->delete();

        return redirect()->route('informasi-arsip.index')->with('success', 'Klasifikasi Arsip berhasil dihapus.');
    }
}
