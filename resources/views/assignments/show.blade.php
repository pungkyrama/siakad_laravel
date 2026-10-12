@extends('layouts.app')

@section('title', 'Detail Assignment')

@section('content')
<h2>Detail Assignment</h2>
<div class="card">
    <div class="card-body">
        <p><strong>Judul:</strong> {{ $assignment->title }}</p>
        <p><strong>Deskripsi:</strong> {{ $assignment->description }}</p>
        <p><strong>Due Date:</strong> {{ $assignment->due_date ? $assignment->due_date->format('Y-m-d H:i') : '' }}</p>
        <hr>
        <p><strong>Course:</strong> {{ $assignment->course->name ?? '' }}</p>
        <h5>Submissions</h5>
        <ul>
        @foreach($assignment->submissions as $sub)
            <li>{{ $sub->student->user->name ?? $sub->student->nim }} - Score: {{ $sub->score }}</li>
        @endforeach
        </ul>
    </div>
</div>
<a href="{{ route('assignments.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection