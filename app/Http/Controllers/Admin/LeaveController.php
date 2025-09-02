<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.leaves.index', compact('leaves'));
    }

    public function show(Leave $leave)
    {
        return view('admin.leaves.show', compact('leave'));
    }

    public function approve(Leave $leave)
    {
        $leave->status = 'Approved';
        $leave->save();

        return redirect()->back()->with('success', 'Leave approved successfully.');
    }

    public function reject(Leave $leave)
    {
        $leave->status = 'Rejected';
        $leave->save();

        return redirect()->back()->with('success', 'Leave rejected successfully.');
    }
}
