<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with('course')->paginate(10);
        return view('assignments.index', compact('assignments'));
    }





    public function create()
    {
        Gate::authorize('admin');
        $courses = Course::all();
        return view('assignments.create', compact('courses'));
    }




    public function store(Request $request)
    {
        Gate::authorize('admin');
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        Assignment::create($validated);

        return redirect()->route('assignments.index')->with('success', 'Assignment berhasil ditambahkan.');
    }





    public function show(Assignment $assignment)
    {
        $assignment->load(['course', 'submissions']);
        return view('assignments.show', compact('assignment'));
    }





    public function edit(Assignment $assignment)
    {
        Gate::authorize('admin');
        $courses = Course::all();
        return view('assignments.edit', compact('assignment', 'courses'));
    }




    public function update(Request $request, Assignment $assignment)
    {
        Gate::authorize('admin');
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        $assignment->update($validated);

        return redirect()->route('assignments.index')->with('success', 'Assignment berhasil diupdate.');
    }





    public function destroy(Assignment $assignment)
    {
        Gate::authorize('admin');
        $assignment->delete();

        return redirect()->route('assignments.index')->with('success', 'Assignment berhasil dihapus.');
    }
}