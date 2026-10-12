<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ScheduleController extends Controller
{
    
    private const DAYS = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

    

    public function index()
    {
        $schedules = Schedule::with(['course', 'teacher.user', 'classroom'])->orderBy('day')->orderBy('start_time')->paginate(10);

        return view('schedules.index', compact('schedules'));
    }

    
    
    public function create()
    {
        Gate::authorize('admin');

        return view('schedules.create', $this->formData());
    }

    
    
    public function store(Request $request)
    {
        Gate::authorize('admin');

        $validated = $request->validate($this->rules());

        Schedule::create($validated);

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    
    

    public function show(Schedule $schedule)
    {
        $schedule->load(['course.department', 'teacher.user', 'classroom']);
        return view('schedules.show', compact('schedule'));
    }

    
    

    public function edit(Schedule $schedule)
    {
        Gate::authorize('admin');

        return view('schedules.edit', array_merge($this->formData(), compact('schedule')));
    }

    
    

    public function update(Request $request, Schedule $schedule)
    {
        Gate::authorize('admin');

        $validated = $request->validate($this->rules());

        $schedule->update($validated);

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil diupdate.');
    }

    
    

    public function destroy(Schedule $schedule)
    {
        Gate::authorize('admin');

        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    
    

    private function rules(): array
    {
        return [
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:teachers,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'day' => 'required|in:' . implode(',', self::DAYS),
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ];
    }

    
    
    
    private function formData(): array
    {
        return [
            'courses' => Course::orderBy('name')->get(),
            'teachers' => Teacher::with('user')->get()->sortBy('user.name'),
            'classrooms' => Classroom::orderBy('name')->get(),
            'days' => self::DAYS,
        ];
    }
}
