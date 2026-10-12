@extends('layouts.app')

@section('title', 'Tambah Submission')

@section('content')
<h2>Tambah Submission</h2>

<form action="{{ route('submissions.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Assignment</label>
        <select name="assignment_id" class="form-control" required>
            <option value="">Pilih Assignment</option>
            @foreach($assignments as $assignment)
            <option value="{{ $assignment->id }}">{{ $assignment->title }}</option>
            @endforeach
        </select>
    </div>
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
        <label>File</label>
        <input type="file" name="file" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Catatan (Notes)</label>
        <textarea name="notes" class="form-control" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label>Waktu Submit</label>
        <input type="datetime-local" name="submitted_at" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Score</label>
        <input type="number" step="0.01" name="score" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('submissions.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection