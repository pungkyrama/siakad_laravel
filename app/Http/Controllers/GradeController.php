<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['student.user', 'course'])->paginate(10);
        return view('grades.index', compact('grades'));
    }




    public function create()
    {
        Gate::authorize('admin');
        $students = Student::with('user')->get();
        $courses = Course::all();
        return view('grades.create', compact('students', 'courses'));
    }




    public function store(Request $request)
    {
        Gate::authorize('admin');
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'academic_year' => 'required|string|max:50',
            'midterm_score' => 'required|numeric|min:0|max:100',
            'final_score' => 'required|numeric|min:0|max:100',
            'grade_letter' => 'nullable|string|max:2',
        ]);

        if (empty($validated['grade_letter'])) {
            $total = ($validated['midterm_score'] + $validated['final_score']) / 2;
            $validated['grade_letter'] = $this->calculateGradeLetter($total);
        }

        Grade::create($validated);

        return redirect()->route('grades.index')->with('success', 'Grade berhasil ditambahkan.');
    }




    public function show(Grade $grade)
    {
        $grade->load(['student.user', 'course']);
        return view('grades.show', compact('grade'));
    }





    public function edit(Grade $grade)
    {
        Gate::authorize('admin');
        $students = Student::with('user')->get();
        $courses = Course::all();
        return view('grades.edit', compact('grade', 'students', 'courses'));
    }




    public function update(Request $request, Grade $grade)
    {
        Gate::authorize('admin');
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'academic_year' => 'required|string|max:50',
            'midterm_score' => 'required|numeric|min:0|max:100',
            'final_score' => 'required|numeric|min:0|max:100',
            'grade_letter' => 'nullable|string|max:2',
        ]);

        if (empty($validated['grade_letter'])) {
            $total = ($validated['midterm_score'] + $validated['final_score']) / 2;
            $validated['grade_letter'] = $this->calculateGradeLetter($total);
        }

        $grade->update($validated);

        return redirect()->route('grades.index')->with('success', 'Grade berhasil diupdate.');
    }





    public function destroy(Grade $grade)
    {
        Gate::authorize('admin');
        $grade->delete();

        return redirect()->route('grades.index')->with('success', 'Grade berhasil dihapus.');
    }




    private function calculateGradeLetter($score)
    {
        if ($score >= 85) return 'A';
        if ($score >= 70) return 'B';
        if ($score >= 55) return 'C';
        if ($score >= 40) return 'D';
        return 'E';
    }
}