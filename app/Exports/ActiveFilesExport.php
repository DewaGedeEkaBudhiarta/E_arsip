<?php

namespace App\Exports;

use App\Models\File;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActiveFilesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DB::table('files')->where('status', 'active')->select(
            'kode_klasifikasi',
            'no_berkas',
            'file_name',
            'kurun_waktu',
            'indeks',
            'keterangan',
            'classification',
            'kelas'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Kode Klasifikasi',
            'No Berkas',
            'Nama',
            'Kurun Waktu',
            'Indeks',
            'Keterangan',
            'Klasifikasi',
            'Kelas',
        ];
    }
}
