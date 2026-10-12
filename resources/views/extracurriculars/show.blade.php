@extends('layouts.app')

@section('title', 'Detail Ekstrakurikuler')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Detail Ekstrakurikuler: {{ $extracurricular->name }}</h2>
    <a href="{{ route('extracurriculars.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th width="200">Nama</th>
                <td>: {{ $extracurricular->name }}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>: {{ $extracurricular->description ?? '-' }}</td>
            </tr>
            <tr>
                <th>Anggota / Kuota</th>
                <td>: {{ $extracurricular->students->count() }} / {{ $extracurricular->max_members }} orang</td>
            </tr>
        </table>
    </div>
</div>

{{-- Daftar Anggota (Relasi Many-to-Many, kolom tambahan dari tabel pivot) --}}
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Daftar Anggota ({{ $extracurricular->students->count() }})</h5>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Peran</th>
                    <th>Tanggal Bergabung</th>
                </tr>
            </thead>
            <tbody>
                @forelse($extracurricular->students as $student)
                <tr>
                    <td>{{ $student->nim }}</td>
                    <td><a href="{{ route('students.show', $student) }}">{{ $student->user->name }}</a></td>
                    <td>{{ $student->department->name }}</td>
                    <td>{{ ucfirst($student->pivot->role) }}</td>
                    <td>
                        {{ $student->pivot->joined_at
                            ? \Carbon\Carbon::parse($student->pivot->joined_at)->format('d M Y')
                            : '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada anggota.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection