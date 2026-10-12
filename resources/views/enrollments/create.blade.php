@extends('layouts.app')

@section('title', 'Tambah Enrollment')

@section('content')
<h2>Tambah Enrollment</h2>

<form action="{{ route('enrollments.store') }}" method="POST">
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
        <label>Semester</label>
        <select name="semester" class="form-control" required>
            <option value="Ganjil">Ganjil</option>
            <option value="Genap">Genap</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control" required>
            <option value="Active">Active</option>
            <option value="Completed">Completed</option>
            <option value="Dropped">Dropped</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection