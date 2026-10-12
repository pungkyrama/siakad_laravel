@extends('layouts.app')

@section('title', 'Detail Enrollment')

@section('content')
<h2>Detail Enrollment</h2>
<div class="card">
    <div class="card-body">
        <p><strong>Tahun Ajaran:</strong> {{ $enrollment->academic_year }}</p>
        <p><strong>Semester:</strong> {{ $enrollment->semester }}</p>
        <p><strong>Status:</strong> {{ $enrollment->status }}</p>
        <hr>
        <p><strong>Mahasiswa:</strong> {{ $enrollment->student->user->name ?? $enrollment->student->nim }} ({{ $enrollment->student->nim ?? '' }})</p>
        <p><strong>Course:</strong> {{ $enrollment->course->name ?? '' }} ({{ $enrollment->course->code ?? '' }})</p>
    </div>
</div>
<a href="{{ route('enrollments.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection