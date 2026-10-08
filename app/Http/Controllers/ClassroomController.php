<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ClassroomController extends Controller
{    
    public function index()
    {
        $classrooms = Classroom::withCount('schedules')->orderBy('building')->orderBy('name')->paginate(10);
        return view('classrooms.index', compact('classrooms'));
    }

   

    public function create()
    {
        Gate::authorize('admin');
        return view('classrooms.create');
    }

    

    public function store(Request $request)
    {
        Gate::authorize('admin');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'building' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        Classroom::create($validated);

        return redirect()->route('classrooms.index')->with('success', 'Ruang kelas berhasil ditambahkan.');
    }

    

    public function show(Classroom $classroom)
    {
        $classroom->load(['schedules.course', 'schedules.teacher.user']);
        return view('classrooms.show', compact('classroom'));
    }

    


    public function edit(Classroom $classroom)
    {
        Gate::authorize('admin');
        return view('classrooms.edit', compact('classroom'));
    }

    


    public function update(Request $request, Classroom $classroom)
    {
        Gate::authorize('admin');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'building' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        $classroom->update($validated);

        return redirect()->route('classrooms.index')->with('success', 'Ruang kelas berhasil diupdate.');
    }

    


    public function destroy(Classroom $classroom)
    {
        Gate::authorize('admin');

        $classroom->delete();

        return redirect()->route('classrooms.index')->with('success', 'Ruang kelas berhasil dihapus.');
    }
}
