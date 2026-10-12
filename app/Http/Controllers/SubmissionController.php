<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Assignment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = Submission::with(['assignment', 'student.user'])->paginate(10);
        return view('submissions.index', compact('submissions'));
    }




    public function create()
    {
        Gate::authorize('admin');
        $assignments = Assignment::all();
        $students = Student::with('user')->get();
        return view('submissions.create', compact('assignments', 'students'));
    }





    public function store(Request $request)
    {
        Gate::authorize('admin');
        $validated = $request->validate([
            'assignment_id' => 'required|exists:assignments,id',
            'student_id' => 'required|exists:students,id',
            'file' => 'required|file|max:10240',
            'notes' => 'nullable|string',
            'submitted_at' => 'required|date',
            'score' => 'nullable|numeric|min:0|max:100',
        ]);

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('submissions', 'public');
        }

        unset($validated['file']);
        Submission::create($validated);

        return redirect()->route('submissions.index')->with('success', 'Submission berhasil ditambahkan.');
    }




    public function show(Submission $submission)
    {
        $submission->load(['assignment', 'student.user']);
        return view('submissions.show', compact('submission'));
    }




    public function edit(Submission $submission)
    {
        Gate::authorize('admin');
        $assignments = Assignment::all();
        $students = Student::with('user')->get();
        return view('submissions.edit', compact('submission', 'assignments', 'students'));
    }





    public function update(Request $request, Submission $submission)
    {
        Gate::authorize('admin');
        $validated = $request->validate([
            'assignment_id' => 'required|exists:assignments,id',
            'student_id' => 'required|exists:students,id',
            'file' => 'nullable|file|max:10240',
            'notes' => 'nullable|string',
            'submitted_at' => 'required|date',
            'score' => 'nullable|numeric|min:0|max:100',
        ]);

        if ($request->hasFile('file')) {
            if ($submission->file_path) {
                Storage::disk('public')->delete($submission->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('submissions', 'public');
        }

        unset($validated['file']);
        $submission->update($validated);

        return redirect()->route('submissions.index')->with('success', 'Submission berhasil diupdate.');
    }





    public function destroy(Submission $submission)
    {
        Gate::authorize('admin');
        if ($submission->file_path) {
            Storage::disk('public')->delete($submission->file_path);
        }
        $submission->delete();

        return redirect()->route('submissions.index')->with('success', 'Submission berhasil dihapus.');
    }
}