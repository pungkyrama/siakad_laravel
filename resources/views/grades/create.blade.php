@extends('layouts.app')

@section('title', 'Tambah Grade')

@section('content')
<h2>Tambah Grade</h2>

<form action="{{ route('grades.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Mahasiswa</label>
        <select name="student_id" class="form-control" required>
            <option value="">Pilih Mahasiswa</option>
            @foreach($students as $student)
            <option value="{{ $student->id }}">{{ $student->user->name ?? $student->nim }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Course</label>
        <select name="course_id" class="form-control" required>
            <option value="">Pilih Course</option>
            @foreach($courses as $course)
            <option value="{{ $course->id }}">{{ $course->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Tahun Ajaran</label>
        <input type="text" name="academic_year" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nilai UTS (Midterm Score)</label>
        <input type="number" step="0.01" name="midterm_score" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nilai UAS (Final Score)</label>
        <input type="number" step="0.01" name="final_score" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Grade Letter (Opsional, kosongkan untuk hitung otomatis)</label>
        <select name="grade_letter" class="form-control">
            <option value="">-- Hitung Otomatis --</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('grades.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection