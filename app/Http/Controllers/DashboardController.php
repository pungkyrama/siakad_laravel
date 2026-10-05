<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'students' => Student::count(),
            'teachers' => Teacher::count(),
            'courses' => Course::count(),
            'departments' => Department::count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
