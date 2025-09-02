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
            'to_date'   => 'required|date|after_or_equal:from_date',
            'reason'    => 'required|string|max:255',
        ]);

        $leave = Leave::create([
            'user_id'   => Auth::id(),
            'from_date' => $request->from_date,
            'to_date'   => $request->to_date,
            'reason'    => $request->reason,
            'status'    => 'Pending',
        ]);

        // Get the user who submitted the request
        $user = auth()->user();

        // Get admin WhatsApp number from .env
        $adminPhone = env('ADMIN_WHATSAPP', '923165279519');

        // Build WhatsApp message for the admin
        $message = "New Leave Request\n\n"
            . "User: {$user->name}\n"
            . "From: {$leave->from_date}\n"
            . "To: {$leave->to_date}\n"
            . "Reason: {$leave->reason}\n\n"
            . "Please review this request in the admin panel.";

        // Send WhatsApp notification to admin
        \App\Helpers\WhatsappHelper::send($adminPhone, $message);

        return redirect()->route('leave.create')->with('success', 'Leave request sent!');
    }


        public function status()
    {
        $leaves = \App\Models\Leave::where('user_id', auth()->id())->latest()->get();
        return view('status', compact('leaves'));
    }
}
