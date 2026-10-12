@extends('layouts.app')

@section('title', 'Detail Dosen')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Detail Dosen: {{ $teacher->user->name }}</h2>
    <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th width="200">NIP</th>
                <td>: {{ $teacher->nip }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>: <a href="{{ route('users.show', $teacher->user) }}">{{ $teacher->user->name }}</a></td>
            </tr>
            <tr>
                <th>Email</th>
                <td>: {{ $teacher->user->email }}</td>
            </tr>
            <tr>
                <th>No. HP</th>
                {{-- Relasi berantai: teacher -> user -> profile --}}
                <td>: {{ $teacher->user->profile?->phone ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jurusan</th>
                <td>: <a href="{{ route('departments.show', $teacher->department) }}">{{ $teacher->department->name }}</a></td>
            </tr>
            <tr>
                <th>Spesialisasi</th>
                <td>: {{ $teacher->specialization ?? '-' }}</td>
            </tr>
        </table>
    </div>
</div>

{{-- Jadwal Mengajar (Relasi One-to-Many) --}}
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Jadwal Mengajar ({{ $teacher->schedules->count() }})</h5>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Mata Kuliah</th>
                    <th>Ruangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teacher->schedules as $schedule)
                <tr>
                    <td>{{ $schedule->day }}</td>
                    <td>{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</td>
                    <td>{{ $schedule->course->name }}</td>
                    <td>{{ $schedule->classroom->name }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada jadwal mengajar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection