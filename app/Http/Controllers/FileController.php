<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:png,jpg,jpeg,gif,xlsx,pdf,doc|max:2048',
            'kode_klasifikasi' => 'required|string|max:255',
            'no_berkas' => 'required|string|max:255',
            'kurun_waktu' => 'required|string|max:255',
            'indeks' => 'required|string|max:255',
            'keterangan' => 'required|string'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            DB::table('files')->insert([
                'file_name' => $fileName,
                'file_path' => '/storage/' . $filePath,
                'kode_klasifikasi' => $request->kode_klasifikasi,
                'no_berkas' => $request->no_berkas,
                'kurun_waktu' => $request->kurun_waktu,
                'indeks' => $request->indeks,
                'keterangan' => $request->keterangan
            ]);

            return back()->with('success', 'File uploaded successfully.');
        } else {
            return back()->with('error', 'File upload failed.');
        }
    }

    public function download($id)
    {
        $file = DB::table('files')->where('id', $id)->first();

        if (!$file) {
            return abort(404);
        }

        return response()->download(public_path($file->file_path), $file->file_name);
    }

    public function showUploadForm()
    {
        $files = DB::table('files')->get();
        // dd($files); // Debugging line to check the content of $files
        return view('arsip-pasi.index', compact('files'));
    }
}
