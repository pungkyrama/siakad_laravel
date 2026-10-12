@extends('layouts.app')

@section('title', 'Edit Grade')

@section('content')
<h2>Edit Grade</h2>

<form action="{{ route('grades.update', $grade->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Mahasiswa</label>
        <select name="student_id" class="form-control" required>
            @foreach($students as $student)
            <option value="{{ $student->id }}" {{ $grade->student_id == $student->id ? 'selected' : '' }}>{{ $student->user->name ?? $student->nim }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Course</label>
        <select name="course_id" class="form-control" required>
            @foreach($courses as $course)
            <option value="{{ $course->id }}" {{ $grade->course_id == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Tahun Ajaran</label>
        <input type="text" name="academic_year" class="form-control" value="{{ $grade->academic_year }}" required>
    </div>
    <div class="mb-3">
        <label>Nilai UTS (Midterm Score)</label>
        <input type="number" step="0.01" name="midterm_score" class="form-control" value="{{ $grade->midterm_score }}" required>
    </div>
    <div class="mb-3">
        <label>Nilai UAS (Final Score)</label>
        <input type="number" step="0.01" name="final_score" class="form-control" value="{{ $grade->final_score }}" required>
    </div>
    <div class="mb-3">
        <label>Grade Letter (Opsional, kosongkan untuk hitung otomatis)</label>
        <select name="grade_letter" class="form-control">
            <option value="">-- Hitung Otomatis --</option>
            <option value="A" {{ $grade->grade_letter == 'A' ? 'selected' : '' }}>A</option>
            <option value="B" {{ $grade->grade_letter == 'B' ? 'selected' : '' }}>B</option>
            <option value="C" {{ $grade->grade_letter == 'C' ? 'selected' : '' }}>C</option>
            <option value="D" {{ $grade->grade_letter == 'D' ? 'selected' : '' }}>D</option>
            <option value="E" {{ $grade->grade_letter == 'E' ? 'selected' : '' }}>E</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('grades.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection