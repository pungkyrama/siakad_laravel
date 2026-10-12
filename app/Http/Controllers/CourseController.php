<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Department;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    
    public function index()
    {
        $courses = Course::with(['category', 'department', 'tags'])->orderBy('code')->paginate(10);
        return view('courses.index', compact('courses'));
    }

    


    public function create()
    {
        Gate::authorize('admin');

        $categories = Category::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('courses.create', compact('categories', 'departments', 'tags'));
    }

   

    public function store(Request $request)
    {
        Gate::authorize('admin');

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'department_id' => 'required|exists:departments,id',
            'code' => 'required|string|max:10|unique:courses,code',
            'name' => 'required|string|max:255',
            'credits' => 'required|integer|min:1|max:6',
            'description' => 'nullable|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $course = Course::create(Arr::except($validated, 'tags'));

       
        $course->tags()->sync($request->input('tags', []));

        return redirect()->route('courses.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    
    

    public function show(Course $course)
    {
        $course->load([
            'category',
            'department',
            'tags',
            'schedules.teacher.user',
            'schedules.classroom',
            'assignments',
            'students.user',
        ]);

        return view('courses.show', compact('course'));
    }

    
    

    public function edit(Course $course)
    {
        Gate::authorize('admin');

        $categories = Category::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $course->load('tags');

        return view('courses.edit', compact('course', 'categories', 'departments', 'tags'));
    }

   
    

    public function update(Request $request, Course $course)
    {
        Gate::authorize('admin');

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'department_id' => 'required|exists:departments,id',
            'code' => 'required|string|max:10|unique:courses,code,' . $course->id,
            'name' => 'required|string|max:255',
            'credits' => 'required|integer|min:1|max:6',
            'description' => 'nullable|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $course->update(Arr::except($validated, 'tags'));
        
        
        $course->tags()->sync($request->input('tags', []));

        return redirect()->route('courses.index')->with('success', 'Mata kuliah berhasil diupdate.');
    }

    
    

    public function destroy(Course $course)
    {
        Gate::authorize('admin');

        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
