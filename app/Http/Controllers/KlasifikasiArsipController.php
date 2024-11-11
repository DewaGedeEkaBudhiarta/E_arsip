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
}
