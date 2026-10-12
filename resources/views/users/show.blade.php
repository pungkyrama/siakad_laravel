@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Detail User: {{ $user->name }}</h2>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th width="200">Nama</th>
                <td>: {{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>: {{ $user->email }}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td>:
                    <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </td>
            </tr>
            <tr>
                <th>Terdaftar sejak</th>
                <td>: {{ $user->created_at->format('d M Y H:i') }}</td>
            </tr>
        </table>
    </div>
</div>

{{-- Profil (Relasi One-to-One) --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Profil</h5>
    </div>
    <div class="card-body">
        @if($user->profile)
        <table class="table table-borderless mb-0">
            <tr>
                <th width="200">No. HP</th>
                <td>: {{ $user->profile->phone ?? '-' }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>: {{ $user->profile->address ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal Lahir</th>
                <td>: {{ $user->profile->birth_date?->format('d M Y') ?? '-' }}</td>
            </tr>
        </table>
        <a href="{{ route('profiles.show', $user->profile) }}" class="btn btn-sm btn-outline-primary mt-2">Lihat Profil</a>
        @else
        <p class="text-muted mb-2">User ini belum memiliki profil.</p>
        @can('admin')
        <a href="{{ route('profiles.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle"></i> Buat Profil
        </a>
        @endcan
        @endif
    </div>
</div>

{{-- Data Akademik (Relasi One-to-One ke teachers atau students) --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Data Akademik</h5>
    </div>
    <div class="card-body">
        @if($user->teacher)
        <p class="mb-1"><span class="badge bg-warning text-dark">Dosen</span></p>
        <p class="mb-1">NIP: {{ $user->teacher->nip }}</p>
        <p class="mb-1">Jurusan: {{ $user->teacher->department->name }}</p>
        <p class="mb-2">Spesialisasi: {{ $user->teacher->specialization ?? '-' }}</p>
        <a href="{{ route('teachers.show', $user->teacher) }}" class="btn btn-sm btn-outline-primary">Lihat Data Dosen</a>
        @elseif($user->student)
        <p class="mb-1"><span class="badge bg-success">Mahasiswa</span></p>
        <p class="mb-1">NIM: {{ $user->student->nim }}</p>
        <p class="mb-1">Jurusan: {{ $user->student->department->name }}</p>
        <p class="mb-2">Semester: {{ $user->student->semester }}</p>
        <a href="{{ route('students.show', $user->student) }}" class="btn btn-sm btn-outline-primary">Lihat Data Mahasiswa</a>
        @else
        <p class="text-muted mb-0">User ini tidak terdaftar sebagai dosen maupun mahasiswa.</p>
        @endif
    </div>
</div>

{{-- Pengumuman yang dibuat user ini (Relasi One-to-Many) --}}
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Pengumuman yang Dibuat ({{ $user->announcements->count() }})</h5>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($user->announcements as $announcement)
                <tr>
                    <td>{{ $announcement->title }}</td>
                    <td>
                        <span class="badge bg-{{ $announcement->is_published ? 'success' : 'secondary' }}">
                            {{ $announcement->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td>{{ $announcement->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada pengumuman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection