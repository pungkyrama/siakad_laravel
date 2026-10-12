@extends('layouts.app')

@section('title', 'Edit Assignment')

@section('content')
<h2>Edit Assignment</h2>

<form action="{{ route('assignments.update', $assignment->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Course</label>
        <select name="course_id" class="form-control" required>
            @foreach($courses as $course)
            <option value="{{ $course->id }}" {{ $assignment->course_id == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="title" class="form-control" value="{{ $assignment->title }}" required>
    </div>
    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="description" class="form-control" rows="3">{{ $assignment->description }}</textarea>
    </div>
    <div class="mb-3">
        <label>Due Date</label>
        <input type="datetime-local" name="due_date" class="form-control" value="{{ $assignment->due_date ? $assignment->due_date->format('Y-m-d\TH:i') : '' }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('assignments.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection