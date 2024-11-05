<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get();
        $files = DB::table('files')->get(); // Fetch files to display in the form
        return view('users-list.index', compact('users', 'files'));
    }

    public function givePermission(Request $request, $userId)
    {
        $request->validate([
            'file_id' => 'required|integer|exists:files,id',
            'classification' => 'required|string|in:terbatas,rahasia'
        ]);

        DB::table('file_user')->insert([
            'file_id' => $request->file_id,
            'user_id' => $userId,
            'classification' => $request->classification,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Permission granted successfully.');
    }

    public function removePermission(Request $request, $userId)
    {
        $request->validate([
            'file_id' => 'required|integer|exists:files,id',
            'classification' => 'required|string|in:terbatas,rahasia'
        ]);

        DB::table('file_user')
            ->where('file_id', $request->file_id)
            ->where('user_id', $userId)
            ->where('classification', $request->classification)
            ->delete();

        return redirect()->back()->with('success', 'Permission removed successfully.');
    }
}
