<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    // Show leave request form
    public function create()
    {
        return view('leave');
    }


    // Store leave request
    public function store(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'reason' => 'required|string|max:255',
        ]);

        Leave::create([
            'user_id' => Auth::id(),
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'reason' => $request->reason,
            'status' => 'Pending',
        ]);

        

        return redirect()->route('leave.create')->with('success', 'Leave request sent!');
    }

        public function status()
    {
        $leaves = \App\Models\Leave::where('user_id', auth()->id())->latest()->get();
        return view('status', compact('leaves'));
    }
}
