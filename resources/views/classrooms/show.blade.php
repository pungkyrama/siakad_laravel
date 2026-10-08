@extends('layouts.app')

@section('title', 'Detail Ruang Kelas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Detail Ruangan: {{ $classroom->name }}</h2>
    <a href="{{ route('classrooms.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th width="200">Nama Ruangan</th>
                <td>: {{ $classroom->name }}</td>
            </tr>
            <tr>
                <th>Gedung</th>
                <td>: {{ $classroom->building }}</td>
            </tr>
            <tr>
                <th>Kapasitas</th>
                <td>: {{ $classroom->capacity }} orang</td>
            </tr>
        </table>
    </div>
</div>

{{-- Daftar Jadwal di Ruangan ini (Relasi One-to-Many) --}}
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Jadwal di Ruangan Ini ({{ $classroom->schedules->count() }})</h5>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classroom->schedules as $schedule)
                <tr>
                    <td>{{ $schedule->day }}</td>
                    <td>{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</td>
                    <td>{{ $schedule->course->name }}</td>
                    <td>{{ $schedule->teacher->user->name }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada jadwal.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection