@extends('layouts.app')

@section('title', 'Detail Submission')

@section('content')
<h2>Detail Submission</h2>
<div class="card">
    <div class="card-body">
        <p><strong>File Path:</strong> {{ $submission->file_path }}</p>
        <p><strong>Notes:</strong> {{ $submission->notes }}</p>
        <p><strong>Submitted At:</strong> {{ $submission->submitted_at ? $submission->submitted_at->format('Y-m-d H:i') : '' }}</p>
        <p><strong>Score:</strong> {{ $submission->score }}</p>
        <hr>
        <p><strong>Assignment:</strong> {{ $submission->assignment->title ?? '' }}</p>
        <p><strong>Mahasiswa:</strong> {{ $submission->student->user->name ?? $submission->student->nim }} ({{ $submission->student->nim ?? '' }})</p>
    </div>
</div>
<a href="{{ route('submissions.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection