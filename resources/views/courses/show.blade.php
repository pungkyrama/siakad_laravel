@extends('layouts.app')

@section('title', 'Detail Mata Kuliah')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Detail Mata Kuliah: {{ $course->name }}</h2>
    <a href="{{ route('courses.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th width="200">Kode</th>
                <td>: {{ $course->code }}</td>
            </tr>
            <tr>
                <th>Nama Mata Kuliah</th>
                <td>: {{ $course->name }}</td>
            </tr>
            <tr>
                <th>SKS</th>
                <td>: {{ $course->credits }}</td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td>: <a href="{{ route('categories.show', $course->category) }}">{{ $course->category->name }}</a></td>
            </tr>
            <tr>
                <th>Jurusan</th>
                <td>: <a href="{{ route('departments.show', $course->department) }}">{{ $course->department->name }}</a></td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>: {{ $course->description ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tags</th>
                <td>:
                    {{-- Relasi Many-to-Many --}}
                    @forelse($course->tags as $tag)
                    <a href="{{ route('tags.show', $tag) }}" class="badge bg-info text-dark text-decoration-none">{{ $tag->name }}</a>
                    @empty
                    -
                    @endforelse
                </td>
            </tr>
        </table>
    </div>
</div>

{{-- Jadwal (Relasi One-to-Many) --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Jadwal Perkuliahan ({{ $course->schedules->count() }})</h5>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Dosen</th>
                    <th>Ruangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($course->schedules as $schedule)
                <tr>
                    <td>{{ $schedule->day }}</td>
                    <td>{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</td>
                    <td>{{ $schedule->teacher->user->name }}</td>
                    <td>{{ $schedule->classroom->name }}</td>
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

{{-- Tugas (Relasi One-to-Many) --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Tugas ({{ $course->assignments->count() }})</h5>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Deadline</th>
                </tr>
            </thead>
            <tbody>
                @forelse($course->assignments as $assignment)
                <tr>
                    <td><a href="{{ route('assignments.show', $assignment) }}">{{ $assignment->title }}</a></td>
                    <td>{{ $assignment->due_date->format('d M Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-center">Belum ada tugas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Mahasiswa yang Mengambil (Relasi Many-to-Many lewat tabel enrollments) --}}
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Mahasiswa Terdaftar ({{ $course->students->count() }})</h5>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Tahun Ajaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($course->students as $student)
                <tr>
                    <td>{{ $student->nim }}</td>
                    <td>{{ $student->user->name }}</td>
                    <td>{{ $student->pivot->academic_year }} ({{ $student->pivot->semester }})</td>
                    <td>{{ ucfirst($student->pivot->status) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada mahasiswa terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection