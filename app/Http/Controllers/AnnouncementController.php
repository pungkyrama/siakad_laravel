<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class AnnouncementController extends Controller
{    

    public function index(Request $request)
    {
        Gate::authorize('viewAny', Announcement::class);

        $announcements = Announcement::with('user')->when(! $request->user()->isAdmin(), fn($query) => $query->where('is_published', true))->latest()->paginate(10);

        return view('announcements.index', compact('announcements'));
    }

    
    

    public function create()
    {
        Gate::authorize('create', Announcement::class);

        return view('announcements.create');
    }

    
    

    public function store(Request $request)
    {
        Gate::authorize('create', Announcement::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_published' => 'nullable|boolean',
        ]);

        
        
        $validated['is_published'] = $request->boolean('is_published');

        
        
        $request->user()->announcements()->create($validated);

        return redirect()->route('announcements.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    
    
    public function show(Announcement $announcement)
    {
        Gate::authorize('view', $announcement);

        $announcement->load('user');

        return view('announcements.show', compact('announcement'));
    }

   
    
    public function edit(Announcement $announcement)
    {
        Gate::authorize('update', $announcement);

        return view('announcements.edit', compact('announcement'));
    }

    
    
    public function update(Request $request, Announcement $announcement)
    {
        Gate::authorize('update', $announcement);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_published' => 'nullable|boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        $announcement->update($validated);

        return redirect()->route('announcements.index')->with('success', 'Pengumuman berhasil diupdate.');
    }

    
    
    public function destroy(Announcement $announcement)
    {
        Gate::authorize('delete', $announcement);

        $announcement->delete();

        return redirect()->route('announcements.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
