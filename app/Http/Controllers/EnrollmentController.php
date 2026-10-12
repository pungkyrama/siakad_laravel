<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['student.user', 'course'])->paginate(10);
        return view('enrollments.index', compact('enrollments'));
    }





    public function create()
    {
        Gate::authorize('admin');
        $students = Student::with('user')->get();
        $courses = Course::all();
        return view('enrollments.create', compact('students', 'courses'));
    }




    public function store(Request $request)
    {
        Gate::authorize('admin');
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'academic_year' => 'required|string|max:50',
            'semester' => 'required|string|max:20',
            'status' => 'required|string|max:50',
        ]);

        Enrollment::create($validated);

        return redirect()->route('enrollments.index')->with('success', 'Enrollment berhasil ditambahkan.');
    }




    public function show(Enrollment $enrollment)
    {
        $enrollment->load(['student.user', 'course']);
        return view('enrollments.show', compact('enrollment'));
    }





    public function edit(Enrollment $enrollment)
    {
        Gate::authorize('admin');
        $students = Student::with('user')->get();
        $courses = Course::all();
        return view('enrollments.edit', compact('enrollment', 'students', 'courses'));
    }




    public function update(Request $request, Enrollment $enrollment)
    {
        Gate::authorize('admin');
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'academic_year' => 'required|string|max:50',
            'semester' => 'required|string|max:20',
            'status' => 'required|string|max:50',
        ]);

        $enrollment->update($validated);

        return redirect()->route('enrollments.index')->with('success', 'Enrollment berhasil diupdate.');
    }




    public function destroy(Enrollment $enrollment)
    {
        Gate::authorize('admin');
        $enrollment->delete();

        return redirect()->route('enrollments.index')->with('success', 'Enrollment berhasil dihapus.');
    }
}