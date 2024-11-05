<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
// In Laravel, there are different ways to interact with the database. The approach you mentioned, using Eloquent models and migrations, is one common way. However, in the code you provided, you are using the Query Builder to interact with the database directly without an Eloquent model
class FileController extends Controller
{
    public function showUploadForm()
    {
        $user = Auth::user();
        $files = DB::table('files');
        // dd($files); // Debugging line to check the content of $files
        if ($user->role == 'admin') {
            $files = $files->get();
        } elseif ($user->role == 'user') {
            $files = $files->where(function ($query) use ($user) {
                $query->where('classification', 'umum')
                      ->orWhere(function ($query) use ($user) {
                          $query->where('classification', 'terbatas')
                                ->where('user_id', $user->id)
                                ->orWhereIn('id', function ($query) use ($user) {
                                    $query->select('file_id')
                                          ->from('file_user')
                                          ->where('user_id', $user->id)
                                          ->where('classification', 'terbatas');
                                });
                      })
                      ->orWhere(function ($query) use ($user) {
                          $query->where('classification', 'rahasia')
                                ->orWhereIn('id', function ($query) use ($user) {
                                    $query->select('file_id')
                                          ->from('file_user')
                                          ->where('user_id', $user->id)
                                          ->where('classification', 'rahasia');
                                });
                      });
            })->get();
        } else {
            $files = $files->where('classification', 'umum')->get();
        }
        return view('arsip-pasi.index', compact('files'));
    }

    public function upload(Request $request)
    {
        // Check if the request is reaching the controller
        // dd('Request reached the controller');

        $request->validate([
            'file' => 'required|mimes:png,jpg,jpeg,gif,xlsx,pdf,docx,pptx|max:5048',
            'kode_klasifikasi' => 'required|string|max:255',
            'no_berkas' => 'required|string|max:255',
            'file_name' => 'required|string|max:255',
            'kurun_waktu' => 'required|string|max:255',
            'indeks' => 'required|string|max:255',
            'keterangan' => 'required|string',
            'classification' => 'required|string|in:umum,terbatas,rahasia'
        ]);
        // Check the validated data
        // dd($request->all());

        // Store the file in the public/uploads directory using the public disk
        $filePath = $request->file('file')->store('uploads', 'public');

        $fileId = DB::table('files')->insertGetId([
            'kode_klasifikasi' => $request->kode_klasifikasi,
            'no_berkas' => $request->no_berkas,
            'file_name' => $request->file_name,
            'kurun_waktu' => $request->kurun_waktu,
            'indeks' => $request->indeks,
            'keterangan' => $request->keterangan,
            'classification' => $request->classification,
            'file_path' => $filePath,
            'user_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Assign permissions to selected users for 'terbatas' files
        if ($request->classification == 'terbatas' && $request->has('users')) {
            foreach ($request->users as $userId) {
                DB::table('file_user')->insert([
                    'file_id' => $fileId,
                    'user_id' => $userId,
                    'classification' => 'terbatas',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function download($id)
    {
        $file = DB::table('files')->where('id', $id)->first();

        if (!$file) {
            return abort(404);
        }

        // Generate the correct file path
        $filePath = storage_path('app/public/' . $file->file_path);

        if (!file_exists($filePath)) {
            return abort(404, 'File not found.');
        }

        return response()->download($filePath, $file->file_name);
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

    // Add a method to update the status of a file
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:active,inactive'
        ]);

        DB::table('files')->where('id', $id)->update([
            'status' => $request->status,
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'File status updated successfully.');
    }
}
