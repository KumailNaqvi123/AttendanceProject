<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::where('user_id', Auth::id())->orderBy('date', 'desc')->get();
        return view('attendance.MarkAttendance', compact('attendances'));
    }

    public function mark()
    {
        $today = now()->toDateString();
        $alreadyMarked = Attendance::where('user_id', Auth::id())->where('date', $today)->exists();

        if ($alreadyMarked) {
            return redirect()->back()->with('error', 'You have already marked attendance today.');
        }

        Attendance::create([
        'user_id' => auth()->id(),
        'date' => now()->toDateString(),
        'status' => 'present',
        ]);

        return redirect()->back()->with('success', 'Attendance marked successfully!');
    }
}
