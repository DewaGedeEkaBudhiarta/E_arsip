<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
// In Laravel, there are different ways to interact with the database. The approach you mentioned, using Eloquent models and migrations, is one common way. However, in the code you provided, you are using the Query Builder to interact with the database directly without an Eloquent model
class FileController extends Controller
{
    public function showUploadForm()
    {
        $files = DB::table('files')->get();
        // dd($files); // Debugging line to check the content of $files
        return view('arsip-pasi.index', compact('files'));
    }

    public function upload(Request $request)
    {
        // Check if the request is reaching the controller
        // dd('Request reached the controller');

        $request->validate([
            'file' => 'required|mimes:png,jpg,jpeg,gif,xlsx,pdf,docx|max:5048',
            'kode_klasifikasi' => 'required|string|max:255',
            'no_berkas' => 'required|string|max:255',
            'file_name' => 'required|string|max:255',
            'kurun_waktu' => 'required|string|max:255',
            'indeks' => 'required|string|max:255',
            'keterangan' => 'required|string'
        ]);
        // Check the validated data
        // dd($request->all());

        // Check if the request has a file
        if ($request->hasFile('file')) {
            // Fetch the file from the request
            $file = $request->file('file');
            // Generate a unique file name
            $fileName = time() . '_' . $file->getClientOriginalName();
            // Store the file in the 'public/uploads' directory
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            // Debugging statement to check the file path
            //dd($filePath);
            // Check the file upload details
            // dd(['fileName' => $fileName, 'filePath' => $filePath]);

            // Prepare the data to be inserted into the database
            $data = [
                'file_name' => $fileName,
                'file_path' => '/storage/' . $filePath,
                'kode_klasifikasi' => $request->kode_klasifikasi,
                'no_berkas' => $request->no_berkas,
                'kurun_waktu' => $request->kurun_waktu,
                'indeks' => $request->indeks,
                'keterangan' => $request->keterangan
            ];
            // Check the data before inserting into the database
            // dd($data);

            // Insert the data into the database using the Query Builder
            DB::table('files')->insert($data);

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

    public function delete($id)
    {
        $file = DB::table('files')->where('id', $id)->first();

        if (!$file) {
            return abort(404);
        }
        // Debugging statement to check the file path
        // dd($file->file_path);

        // Delete the file from storage
        $storagePath = str_replace('/storage/', '', $file->file_path);
        $deleted = Storage::disk('public')->delete($storagePath);
        // Debugging statement to check if the file was deleted
        // dd($deleted);

        // Check if the file was deleted
        if (!$deleted) {
            return back()->with('error', 'File could not be deleted from storage.');
        }

        // Delete the file record from the database
        DB::table('files')->where('id', $id)->delete();

        return back()->with('success', 'File deleted successfully.');
    }
}
