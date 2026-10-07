@extends('layouts.app')

@section('title', 'Detail Jurusan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Detail Jurusan: {{ $department->name }}</h2>
    <a href="{{ route('departments.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th width="200">Kode</th>
                <td>: {{ $department->code }}</td>
            </tr>
            <tr>
                <th>Nama Jurusan</th>
                <td>: {{ $department->name }}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>: {{ $department->description ?? '-' }}</td>
            </tr>
            <tr>
                <th>Dibuat pada</th>
                <td>: {{ $department->created_at->format('d M Y H:i') }}</td>
            </tr>
        </table>
    </div>
</div>

{{-- Daftar Dosen di Jurusan ini (Relasi One-to-Many) --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Dosen di Jurusan Ini ({{ $department->teachers->count() }})</h5>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Spesialisasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($department->teachers as $teacher)
                <tr>
                    <td>{{ $teacher->nip }}</td>
                    <td>{{ $teacher->user->name }}</td>
                    <td>{{ $teacher->specialization ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Daftar Mahasiswa di Jurusan ini (Relasi One-to-Many) --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Mahasiswa di Jurusan Ini ({{ $department->students->count() }})</h5>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Semester</th>
                </tr>
            </thead>
            <tbody>
                @forelse($department->students as $student)
                <tr>
                    <td>{{ $student->nim }}</td>
                    <td>{{ $student->user->name }}</td>
                    <td>{{ $student->semester }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Daftar Mata Kuliah di Jurusan ini (Relasi One-to-Many) --}}
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Mata Kuliah di Jurusan Ini ({{ $department->courses->count() }})</h5>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>SKS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($department->courses as $course)
                <tr>
                    <td>{{ $course->code }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->credits }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection