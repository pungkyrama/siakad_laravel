<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TeacherController extends Controller
{
    
    public function index()
    {
        $teachers = Teacher::with(['user', 'department'])->orderBy('nip')->paginate(10);
        return view('teachers.index', compact('teachers'));
    }

    
    

    public function create()
    {
        Gate::authorize('admin');

        $users = $this->availableUsers();
        $departments = Department::orderBy('name')->get();

        return view('teachers.create', compact('users', 'departments'));
    }

    
    

    public function store(Request $request)
    {
        Gate::authorize('admin');

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:teachers,user_id|unique:students,user_id',
            'department_id' => 'required|exists:departments,id',
            'nip' => 'required|string|max:30|unique:teachers,nip',
            'specialization' => 'nullable|string|max:255',
        ]);

        Teacher::create($validated);

        return redirect()->route('teachers.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    
    

    public function show(Teacher $teacher)
    {
        $teacher->load(['user.profile', 'department', 'schedules.course', 'schedules.classroom']);
        return view('teachers.show', compact('teacher'));
    }

    
    

    public function edit(Teacher $teacher)
    {
        Gate::authorize('admin');

        $users = $this->availableUsers($teacher->user_id);
        $departments = Department::orderBy('name')->get();

        return view('teachers.edit', compact('teacher', 'users', 'departments'));
    }

    
    

    public function update(Request $request, Teacher $teacher)
    {
        Gate::authorize('admin');

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:students,user_id|unique:teachers,user_id,' . $teacher->id,
            'department_id' => 'required|exists:departments,id',
            'nip' => 'required|string|max:30|unique:teachers,nip,' . $teacher->id,
            'specialization' => 'nullable|string|max:255',
        ]);

        $teacher->update($validated);

        return redirect()->route('teachers.index')->with('success', 'Data dosen berhasil diupdate.');
    }

    
    

    public function destroy(Teacher $teacher)
    {
        Gate::authorize('admin');

        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Data dosen berhasil dihapus.');
    }

    
    

    private function availableUsers(?int $currentUserId = null)
    {
        return User::where('role', 'user')->doesntHave('teacher')->doesntHave('student')->when($currentUserId, fn($query) => $query->orWhere('id', $currentUserId))->orderBy('name')->get();
    }
}
