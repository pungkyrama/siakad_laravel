@extends('layouts.app')

@section('title', 'Edit Submission')

@section('content')
<h2>Edit Submission</h2>

<form action="{{ route('submissions.update', $submission->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Assignment</label>
        <select name="assignment_id" class="form-control" required>
            @foreach($assignments as $assignment)
            <option value="{{ $assignment->id }}" {{ $submission->assignment_id == $assignment->id ? 'selected' : '' }}>{{ $assignment->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Mahasiswa</label>
        <select name="student_id" class="form-control" required>
            @foreach($students as $student)
            <option value="{{ $student->id }}" {{ $submission->student_id == $student->id ? 'selected' : '' }}>{{ $student->user->name ?? $student->nim }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>File (Biarkan kosong jika tidak diubah)</label>
        <input type="file" name="file" class="form-control">
        @if($submission->file_path)
        <small>Current file: {{ $submission->file_path }}</small>
        @endif
    </div>
    <div class="mb-3">
        <label>Catatan (Notes)</label>
        <textarea name="notes" class="form-control" rows="3">{{ $submission->notes }}</textarea>
    </div>
    <div class="mb-3">
        <label>Waktu Submit</label>
        <input type="datetime-local" name="submitted_at" class="form-control" value="{{ $submission->submitted_at ? $submission->submitted_at->format('Y-m-d\TH:i') : '' }}" required>
    </div>
    <div class="mb-3">
        <label>Score</label>
        <input type="number" step="0.01" name="score" class="form-control" value="{{ $submission->score }}">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('submissions.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection