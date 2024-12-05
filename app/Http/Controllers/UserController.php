<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get(); // Fetch users to display in the form
        $files = DB::table('files')->get(); // Fetch files to display in the form
        return view('users-list.index', compact('users', 'files'));
    }
    // method to call current user name in sidebar
    public function showNameSidebar()
    {
        $currentUser = Auth::user(); // Fetch the current authenticated user
        return view('partials.sidebar', compact('currentUser'));
    }

    // Assign permissions to selected users for 'terbatas' and 'rahasia' files
    public function givePermission(Request $request, $userId)
    {
        $request->validate([
            'file_id' => 'required|integer|exists:files,id',
            'classification' => 'required|string|in:terbatas,rahasia'
        ]);

        $existingPermission = DB::table('file_user')
            ->where('user_id', $userId)
            ->where('classification', $request->classification)
            ->first();

        if (!$existingPermission) {
            DB::table('file_user')->insert([
                'file_id' => $request->file_id,
                'user_id' => $userId,
                'classification' => $request->classification,
                'created_at' => now(),
                'updated_at' => now()
            ]);


            // Fetch the file details
            $file = DB::table('files')->where('id', $request->file_id)->first();

            // Log the activity
            ActivityLog::create([
                'nomor_berkas' => $file->no_berkas,
                'nama_berkas' => $file->file_name,
                'user_pengakses' => Auth::user()->name,
                'jam_ubah_create' => now(),
                'tanggal' => now()->toDateString(),
                'status' => 'completed',
                'action' => 'permission_granted',
            ]);
            return redirect()->back()->with('success', 'Permission granted successfully.');
        } else {
            return redirect()->back()->with('error', 'Permission already exists.');
        }
    }

    public function removePermission(Request $request, $userId)
    {
        $request->validate([
            'file_id' => 'required|integer|exists:files,id',
            'classification' => 'required|string|in:terbatas,rahasia'
        ]);

        $deleted = DB::table('file_user')
            ->where('file_id', $request->file_id)
            ->where('user_id', $userId)
            ->where('classification', $request->classification)
            ->delete();

        if ($deleted) {
            // Fetch the file details
            $file = DB::table('files')->where('id', $request->file_id)->first();

            // Log the activity
            ActivityLog::create([
                'nomor_berkas' => $file->no_berkas,
                'nama_berkas' => $file->file_name,
                'user_pengakses' => Auth::user()->name,
                'jam_ubah_create' => now(),
                'tanggal' => now()->toDateString(),
                'status' => 'completed',
                'action' => 'permission_revoked',
            ]);
            return redirect()->back()->with('success', 'Permission removed successfully.');
        } else {
            return redirect()->back()->with('error', 'Permission not found.');
        }
    }
}
