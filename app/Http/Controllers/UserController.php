<?php

namespace App\Http\Controllers;

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
            return redirect()->back()->with('success', 'Permission removed successfully.');
        } else {
            return redirect()->back()->with('error', 'Permission not found.');
        }
    }
}
