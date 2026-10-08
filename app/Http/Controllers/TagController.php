<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::withCount('courses')->orderBy('name')->paginate(10);
        return view('tags.index', compact('tags'));
    }

    
    
    public function create()
    {
        Gate::authorize('admin');
        return view('tags.create');
    }

    
    
    public function store(Request $request)
    {
        Gate::authorize('admin');

        
        $request->merge([
            'slug' => Str::slug($request->input('slug') ?: $request->input('name')),
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tags,slug',
        ]);

        Tag::create($validated);

        return redirect()->route('tags.index')
            ->with('success', 'Tag berhasil ditambahkan.');
    }

    
    
    public function show(Tag $tag)
    {
        $tag->load('courses.department');
        return view('tags.show', compact('tag'));
    }

    
    
    public function edit(Tag $tag)
    {
        Gate::authorize('admin');
        return view('tags.edit', compact('tag'));
    }

    
    
    public function update(Request $request, Tag $tag)
    {
        Gate::authorize('admin');

        $request->merge([
            'slug' => Str::slug($request->input('slug') ?: $request->input('name')),
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tags,slug,' . $tag->id,
        ]);

        $tag->update($validated);

        return redirect()->route('tags.index')
            ->with('success', 'Tag berhasil diupdate.');
    }

    
    
    public function destroy(Tag $tag)
    {
        Gate::authorize('admin');

        $tag->delete();

        return redirect()->route('tags.index')
            ->with('success', 'Tag berhasil dihapus.');
    }
}
