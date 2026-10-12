<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Extracurricular;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;

class StudentController extends Controller
{ 

    public function index()
    {
        $students = Student::with(['user', 'department'])->orderBy('nim')->paginate(10);
        return view('students.index', compact('students'));
    }

    
    
    public function create()
    {
        Gate::authorize('admin');

        $users = $this->availableUsers();
        $departments = Department::orderBy('name')->get();
        $extracurriculars = Extracurricular::orderBy('name')->get();

        return view('students.create', compact('users', 'departments', 'extracurriculars'));
    }

   
    
    public function store(Request $request)
    {
        Gate::authorize('admin');

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:students,user_id|unique:teachers,user_id',
            'department_id' => 'required|exists:departments,id',
            'nim' => 'required|string|max:20|unique:students,nim',
            'semester' => 'required|integer|min:1|max:14',
            'extracurriculars' => 'nullable|array',
            'extracurriculars.*' => 'exists:extracurriculars,id',
        ]);

       
        
        $student = Student::create(Arr::except($validated, 'extracurriculars'));

       
        
        $student->extracurriculars()->attach($request->input('extracurriculars', []), [
            'joined_at' => now()->toDateString(),
            'role' => 'member',
        ]);

        return redirect()->route('students.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    
    
    public function show(Student $student)
    {
        $student->load(['user.profile', 'department', 'courses', 'grades.course', 'extracurriculars']);
        return view('students.show', compact('student'));
    }

   
    
    public function edit(Student $student)
    {
        Gate::authorize('admin');

        $users = $this->availableUsers($student->user_id);
        $departments = Department::orderBy('name')->get();
        $extracurriculars = Extracurricular::orderBy('name')->get();
        $student->load('extracurriculars');

        return view('students.edit', compact('student', 'users', 'departments', 'extracurriculars'));
    }

    
    
    public function update(Request $request, Student $student)
    {
        Gate::authorize('admin');

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:teachers,user_id|unique:students,user_id,' . $student->id,
            'department_id' => 'required|exists:departments,id',
            'nim' => 'required|string|max:20|unique:students,nim,' . $student->id,
            'semester' => 'required|integer|min:1|max:14',
            'extracurriculars' => 'nullable|array',
            'extracurriculars.*' => 'exists:extracurriculars,id',
        ]);

        $student->update(Arr::except($validated, 'extracurriculars'));

        
        
        $changes = $student->extracurriculars()->sync($request->input('extracurriculars', []));

       
        
        foreach ($changes['attached'] as $extracurricularId) {
            $student->extracurriculars()->updateExistingPivot($extracurricularId, [
                'joined_at' => now()->toDateString(),
            ]);
        }

        return redirect()->route('students.index')->with('success', 'Data mahasiswa berhasil diupdate.');
    }

   
    
    public function destroy(Student $student)
    {
        Gate::authorize('admin');

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    
    
    private function availableUsers(?int $currentUserId = null)
    {
        return User::where('role', 'user')->doesntHave('teacher')->doesntHave('student')->when($currentUserId, fn($query) => $query->orWhere('id', $currentUserId))->orderBy('name')->get();
    }
}
