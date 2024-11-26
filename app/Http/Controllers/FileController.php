<?php

namespace App\Http\Controllers;

use App\Exports\ActiveFilesExport;
use App\Exports\FilesExport;
use App\Exports\InactiveFilesExport;
use App\Exports\UsulMusnahFilesExport;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

// In Laravel, there are different ways to interact with the database. The approach you mentioned, using Eloquent models and migrations, is one common way. However, in the code you provided, you are using the Query Builder to interact with the database directly without an Eloquent model
class FileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $files = DB::table('files');
        // dd($files); // Debugging line to check the content of $files

        if ($user->role == 'admin') {
            $files = $files->get();
        } elseif ($user->role == 'user') {
            $files = $files->where(function ($query) use ($user) {
                $query->where('classification', 'terbuka')
                      ->orWhere('user_id', $user->id)
                      ->orWhereIn('id', function ($query) use ($user) {
                          $query->select('file_id')
                                ->from('file_user')
                                ->where('user_id', $user->id);
                      });
            })->get();
        } else {
            $files = $files->where('classification', 'terbuka')->get();
        }

        return view('arsip-pasi.index', compact('files'));
    }
    public function showUploadForm()
    {
        // Fetch unique Transaksi values
        $transaksiList = DB::table('klasifikasi_arsip')->select('Transaksi')->distinct()->get();
        
        // Fetch all records for dynamic Indeks change
        $klasifikasiArsip = DB::table('klasifikasi_arsip')->get();
        
        return view('uploud-file.index', compact('transaksiList', 'klasifikasiArsip'));
    }

    public function upload(Request $request)
    {
        // Check if the request is reaching the controller
        // dd('Request reached the controller');

        $request->validate([
            'file' => 'required|mimes:png,jpg,jpeg,xlsx,pdf,docx,pptx,csv,text/csv|max:15048',
            'kode_klasifikasi' => 'required|string|max:255',
            'no_berkas' => 'required|string|max:255',
            'file_name' => 'required|string|max:255',
            'kurun_waktu' => 'required|string|max:255',
            'indeks' => 'nullable|string|max:255',
            'keterangan' => 'required|string',
            'classification' => 'required|string|in:terbuka,terbatas,tertutup',
            'kelas' => 'required|string|in:umum,vital'
        ]);
        // dd('Validation passed', $request->all());
    
        // Store the file in the public/uploads directory using the public disk
        $filePath = $request->file('file')->store('uploads', 'public');
        // dd('File stored at: ' . $filePath);
    
        // Get the original file extension
        $extension = $request->file('file')->getClientOriginalExtension();
        // dd('File extension: ' . $extension);
    
        // Combine the file name from the form input with the original extension
        $fileNameWithExtension = $request->file_name . '.' . $extension;
        // dd('File name with extension: ' . $fileNameWithExtension);
    
        $fileId = DB::table('files')->insertGetId([
            'kode_klasifikasi' => $request->kode_klasifikasi,
            'no_berkas' => $request->no_berkas,
            'file_name' => $fileNameWithExtension, // Use the file name from the form input with the original extension
            'kurun_waktu' => $request->kurun_waktu,
            'indeks' => $request->indeks,
            'keterangan' => $request->keterangan,
            'classification' => $request->classification,
            'kelas' => $request->kelas,
            'file_path' => $filePath,
            'user_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);        
        
        // Log the activity
        ActivityLog::create([
            'nomor_berkas' => $request->no_berkas,
            'nama_berkas' => $request->file_name,
            'user_pengakses' => Auth::user()->name,
            'jam_ubah_create' => now(),
            'tanggal' => now()->toDateString(),
            'status' => 'completed',
            'action' => 'created',
        ]);

        return redirect()->route('arsip-pasi.index')->with('success', 'File uploaded successfully.');
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

        // Use the original file name with extension
        $fileName = $file->file_name;

        return response()->download($filePath, $fileName);
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
            'status' => 'required|string|in:active,inactive,usul_musnah'
        ]);
    
        // Fetch the file details
        $file = DB::table('files')->find($id);
    
        if ($file) {
            // Update the file status
            DB::table('files')->where('id', $id)->update([
                'status' => $request->status,
                'updated_at' => now()
            ]);
    
            // Log the activity
            ActivityLog::create([
                'nomor_berkas' => $file->no_berkas,
                'nama_berkas' => $file->file_name,
                'user_pengakses' => Auth::user()->name,
                'jam_ubah_create' => now(),
                'tanggal' => now()->toDateString(),
                'status' => 'completed',
                'action' => 'status updated to ' . $request->status,
            ]);
    
            return redirect()->back()->with('success', 'File status updated successfully.');
        }
    
        return redirect()->back()->with('error', 'File not found.');
    }
    
    public function edit($id)
    {
        $file = DB::table('files')->find($id);
        $transaksiList = DB::table('klasifikasi_arsip')
                            ->select('id', 'Transaksi')
                            ->distinct()
                            ->whereNotNull('Transaksi')
                            ->where('Transaksi', '!=', '')
                            ->get(); // Fetch unique Transaksi values that are not empty or null
        $klasifikasiArsip = DB::table('klasifikasi_arsip')->get(); // Fetch all klasifikasi_arsip data
        return view('uploud-file.partials.update-file', compact('file', 'transaksiList', 'klasifikasiArsip'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'nullable|mimes:png,jpg,jpeg,xlsx,pdf,docx,pptx,csv,text/csv|max:15048',
            'kode_klasifikasi' => 'required|string|max:255',
            'no_berkas' => 'required|string|max:255',
            'file_name' => 'required|string|max:255',
            'kurun_waktu' => 'required|string|max:255',
            'indeks' => 'nullable|string|max:255',
            'keterangan' => 'required|string',
            'classification' => 'required|string|in:terbuka,terbatas,tertutup',
            'kelas' => 'required|string|in:umum,vital'
        ]);

        $fileData = [
            'kode_klasifikasi' => $request->kode_klasifikasi,
            'no_berkas' => $request->no_berkas,
            'file_name' => $request->file_name,
            'kurun_waktu' => $request->kurun_waktu,
            'indeks' => $request->indeks,
            'keterangan' => $request->keterangan,
            'classification' => $request->classification,
            'kelas' => $request->kelas,
            'updated_at' => now(),
        ];

        if ($request->hasFile('file')) {
            // Store the file in the public/uploads directory using the public disk
            $filePath = $request->file('file')->store('uploads', 'public');
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileNameWithExtension = $request->file_name . '.' . $extension;
            $fileData['file_path'] = $filePath;
            $fileData['file_name_with_extension'] = $fileNameWithExtension;
        }

        DB::table('files')->where('id', $id)->update($fileData);

        // Log the activity
        ActivityLog::create([
            'nomor_berkas' => $request->no_berkas,
            'nama_berkas' => $request->file_name,
            'user_pengakses' => Auth::user()->name,
            'jam_ubah_create' => now(),
            'tanggal' => now()->toDateString(),
            'status' => 'completed',
            'action' => 'updated',
        ]);

        return redirect()->route('arsip-pasi.index')->with('success', 'File updated successfully.');
    }

    public function export()
    {
        return Excel::download(new FilesExport, 'files.xlsx');
    }
    
    public function exportActive()
    {
        return Excel::download(new ActiveFilesExport, 'active_files.xlsx');
    }
    
    public function exportInactive()
    {
        return Excel::download(new InactiveFilesExport, 'inactive_files.xlsx');
    }
    
    public function exportUsulMusnah()
    {
        return Excel::download(new UsulMusnahFilesExport, 'UsulMusnah_files.xlsx');
    }

    public function fileCount()
    {
        $totalArsip = DB::table('files')->count();
        $arsipAktif = DB::table('files')->where('status', 'active')->count();
        $arsipInaktif = DB::table('files')->where('status', 'inactive')->count();
        $usulMusnah = DB::table('files')->where('status', 'usul_musnah')->count();

        return view('home.index', compact('totalArsip', 'arsipAktif', 'arsipInaktif', 'usulMusnah'));
    }
}
