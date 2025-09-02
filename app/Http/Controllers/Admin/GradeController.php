<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class GradeController extends Controller
{
    public function index()
    {
        $students = User::with('attendances')->get();

        return view('admin.grades.index', compact('students'));
    }
}

