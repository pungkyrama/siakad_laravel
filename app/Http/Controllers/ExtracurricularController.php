<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ExtracurricularController extends Controller
{
    

    public function index()
    {
        $extracurriculars = Extracurricular::withCount('students')->orderBy('name')->paginate(10);
        return view('extracurriculars.index', compact('extracurriculars'));
    }

    
    

    public function create()
    {
        Gate::authorize('admin');
        return view('extracurriculars.create');
    }

    
    

    public function store(Request $request)
    {
        Gate::authorize('admin');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_members' => 'required|integer|min:1',
        ]);

        Extracurricular::create($validated);

        return redirect()->route('extracurriculars.index')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    
    

    public function show(Extracurricular $extracurricular)
    {
        $extracurricular->load(['students.user', 'students.department']);
        return view('extracurriculars.show', compact('extracurricular'));
    }

    
    

    public function edit(Extracurricular $extracurricular)
    {
        Gate::authorize('admin');
        return view('extracurriculars.edit', compact('extracurricular'));
    }

    
    

    public function update(Request $request, Extracurricular $extracurricular)
    {
        Gate::authorize('admin');

        
        
        $memberCount = $extracurricular->students()->count();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_members' => 'required|integer|min:' . max(1, $memberCount),
        ]);

        $extracurricular->update($validated);

        return redirect()->route('extracurriculars.index')->with('success', 'Ekstrakurikuler berhasil diupdate.');
    }

    
    

    public function destroy(Extracurricular $extracurricular)
    {
        Gate::authorize('admin');

        $extracurricular->delete();

        return redirect()->route('extracurriculars.index')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}
