<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('courses')->orderBy('name')->pagination(8);
        return view('categories.index', compact('categories'));
    }


    public function create()
    {
        Gate::authorize('admin');
        return view('categories.create');
    }


    public function store(Request $request)
    {
        Gate::authorize('admin');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }


    public function show(Category $category)
    {
        $category->load('courses.department');
        return view('categories.show', compact('category'));
    }


    public function edit(Category $category)
    {
        Gate::authorize('admin');
        return view('categories.edit', compact('category'));
    }




    public function update(Request $request, Category $category)
    {
        Gate::authorize('admin');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diupdate.');
    }



    public function destroy(Category $category)
    {
        Gate::authorize('admin');

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
