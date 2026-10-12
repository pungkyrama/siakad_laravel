@extends('layouts.app')

@section('title', 'Edit Enrollment')

@section('content')
<h2>Edit Enrollment</h2>

<form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Mahasiswa</label>
        <select name="student_id" class="form-control" required>
            @foreach($students as $student)
            <option value="{{ $student->id }}" {{ $enrollment->student_id == $student->id ? 'selected' : '' }}>{{ $student->user->name ?? $student->nim }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Course</label>
        <select name="course_id" class="form-control" required>
            @foreach($courses as $course)
            <option value="{{ $course->id }}" {{ $enrollment->course_id == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Tahun Ajaran</label>
        <input type="text" name="academic_year" class="form-control" value="{{ $enrollment->academic_year }}" required>
    </div>
    <div class="mb-3">
        <label>Semester</label>
        <select name="semester" class="form-control" required>
            <option value="Ganjil" {{ $enrollment->semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
            <option value="Genap" {{ $enrollment->semester == 'Genap' ? 'selected' : '' }}>Genap</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control" required>
            <option value="Active" {{ $enrollment->status == 'Active' ? 'selected' : '' }}>Active</option>
            <option value="Completed" {{ $enrollment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            <option value="Dropped" {{ $enrollment->status == 'Dropped' ? 'selected' : '' }}>Dropped</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection