@extends('layouts.app')

@section('title', 'Tambah Assignment')

@section('content')
<h2>Tambah Assignment</h2>

<form action="{{ route('assignments.store') }}" method="POST">
    @csrf
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
        <label>Judul</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="description" class="form-control" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label>Due Date</label>
        <input type="datetime-local" name="due_date" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('assignments.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection