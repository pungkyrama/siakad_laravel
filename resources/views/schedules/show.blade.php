@extends('layouts.app')

@section('title', 'Detail Jadwal')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Detail Jadwal</h2>
    <a href="{{ route('schedules.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th width="200">Hari</th>
                <td>: {{ $schedule->day }}</td>
            </tr>
            <tr>
                <th>Jam</th>
                <td>: {{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</td>
            </tr>
            {{-- Relasi Many-to-One: schedule milik satu course, teacher, dan classroom --}}
            <tr>
                <th>Mata Kuliah</th>
                <td>: <a href="{{ route('courses.show', $schedule->course) }}">{{ $schedule->course->code }} - {{ $schedule->course->name }}</a>
                    ({{ $schedule->course->credits }} SKS)</td>
            </tr>
            <tr>
                <th>Jurusan</th>
                <td>: {{ $schedule->course->department->name }}</td>
            </tr>
            <tr>
                <th>Dosen</th>
                <td>: <a href="{{ route('teachers.show', $schedule->teacher) }}">{{ $schedule->teacher->user->name }}</a></td>
            </tr>
            <tr>
                <th>Ruangan</th>
                <td>: <a href="{{ route('classrooms.show', $schedule->classroom) }}">{{ $schedule->classroom->name }}</a>
                    - {{ $schedule->classroom->building }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection