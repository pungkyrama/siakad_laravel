@extends('layouts.app')

@section('title', 'Detail Grade')

@section('content')
<h2>Detail Grade</h2>
<div class="card">
    <div class="card-body">
        <p><strong>Tahun Ajaran:</strong> {{ $grade->academic_year }}</p>
        <p><strong>Midterm Score:</strong> {{ $grade->midterm_score }}</p>
        <p><strong>Final Score:</strong> {{ $grade->final_score }}</p>
        <p><strong>Grade Letter:</strong> {{ $grade->grade_letter }}</p>
        <hr>
        <p><strong>Mahasiswa:</strong> {{ $grade->student->user->name ?? $grade->student->nim }} ({{ $grade->student->nim ?? '' }})</p>
        <p><strong>Course:</strong> {{ $grade->course->name ?? '' }} ({{ $grade->course->code ?? '' }})</p>
    </div>
</div>
<a href="{{ route('grades.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection