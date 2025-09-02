<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;

class ReportController extends Controller {
 // Show all attendance reports 
      public function index(Request $request) 
    { 
	 $query = Attendance::query()->with('user');

 // Optional: filter by student 

	 if ($request->filled('student_id')) 
    {
        $query->where('user_id', $request->student_id); 
	} 
 // Optional: filter by date 
	if ($request->filled('from_date')) 
    { 
		$query->whereDate('created_at', '>=', $request->from_date); 
	} 

    if ($request->filled('to_date')) 
	{ 
        $query->whereDate('created_at', '<=', $request->to_date); 
	}

 		$attendances = $query->orderBy('created_at', 'desc')->get(); 

		$students = User::role('student')->get(); 

 // list of students for filter dropdown 

	return view('admin.reports.index', compact('attendances', 'students')); 

	} 
}