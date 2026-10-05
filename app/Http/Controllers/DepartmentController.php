<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DepartmentController extends Controller
{
    
    public function index()
    {
        $departments = Department::withCount(['teachers', 'students', 'courses'])->paginate(8);
        return view('departments.index', compact('departments'));
    }

    
    public function create()
    {
        Gate::authorize('admin');
        return view('departments.create');
    }

    
    public function store(Request $request)
    {
        Gate::authorize('admin');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:departments,code',
            'description' => 'nullable|string',
        ]);

        Department::create($validated);

        return redirect()->route('departments.index')->with('success', 'Department berhasil ditambahkan.');
    }

    
    public function show(Department $department)
    {
        $department->load(['teachers.user', 'students.user', 'courses']);
        return view('departments.show', compact('department'));
    }

    
    public function edit(Department $department)
    {
        Gate::authorize('admin');
        return view('departments.edit', compact('department'));
    }

    
    public function update(Request $request, Department $department)
    {
        Gate::authorize('admin');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:departments,code,' . $department->id,
            'description' => 'nullable|string',
        ]);

        $department->update($validated);

        return redirect()->route('departments.index')->with('success', 'Department berhasil diupdate.');
    }

    
    public function destroy(Department $department)
    {
        Gate::authorize('admin');

        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Department berhasil dihapus.');
    }
}
