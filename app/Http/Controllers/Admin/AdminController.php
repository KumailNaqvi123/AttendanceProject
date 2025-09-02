<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Admin dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Optional: add more methods as you implement modules
    // public function manageStudents() { ... }
    // public function approveLeaves() { ... }
    // public function viewReports() { ... }
    // public function assignTasks() { ... }
}
