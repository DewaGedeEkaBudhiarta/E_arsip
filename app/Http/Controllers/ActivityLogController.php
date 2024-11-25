<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function showActivityLogs()
    {
        $activityLogs = ActivityLog::orderBy('jam_ubah_create', 'desc')->get();
        return view('log-aktifitas.index', compact('activityLogs'));
    }
 
    public function deleteLog($id)
    {
        $log = ActivityLog::findOrFail($id);
        $log->delete();

        return redirect()->route('activity.logs')->with('success', 'Log activity deleted successfully.');
    }
}
