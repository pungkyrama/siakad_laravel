@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Detail Mahasiswa: {{ $student->user->name }}</h2>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th width="200">NIM</th>
                <td>: {{ $student->nim }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>: <a href="{{ route('users.show', $student->user) }}">{{ $student->user->name }}</a></td>
            </tr>
            <tr>
                <th>Email</th>
                <td>: {{ $student->user->email }}</td>
            </tr>
            <tr>
                <th>No. HP</th>
                <td>: {{ $student->user->profile?->phone ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jurusan</th>
                <td>: <a href="{{ route('departments.show', $student->department) }}">{{ $student->department->name }}</a></td>
            </tr>
            <tr>
                <th>Semester</th>
                <td>: {{ $student->semester }}</td>
            </tr>
        </table>
    </div>
</div>

{{-- Mata Kuliah yang Diambil (Relasi Many-to-Many lewat tabel enrollments) --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Mata Kuliah yang Diambil ({{ $student->courses->count() }})</h5>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Tahun Ajaran</th>
                    <th>Semester</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($student->courses as $course)
                <tr>
                    <td>{{ $course->code }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->credits }}</td>
                    {{-- Kolom tambahan dari tabel pivot diakses lewat ->pivot --}}
                    <td>{{ $course->pivot->academic_year }}</td>
                    <td>{{ $course->pivot->semester }}</td>
                    <td>{{ ucfirst($course->pivot->status) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum mengambil mata kuliah.</td>
                </tr>
                @endforelse
            </tbody>
            @if($student->courses->isNotEmpty())
            <tfoot>
                <tr>
                    <th colspan="2" class="text-end">Total SKS</th>
                    <th colspan="4">{{ $student->courses->sum('credits') }}</th>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>

{{-- Nilai (Relasi One-to-Many) --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Nilai ({{ $student->grades->count() }})</h5>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Mata Kuliah</th>
                    <th>Tahun Ajaran</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th>Nilai Huruf</th>
                </tr>
            </thead>
            <tbody>
                @forelse($student->grades as $grade)
                <tr>
                    <td>{{ $grade->course->name }}</td>
                    <td>{{ $grade->academic_year }}</td>
                    <td>{{ $grade->midterm_score ?? '-' }}</td>
                    <td>{{ $grade->final_score ?? '-' }}</td>
                    <td><strong>{{ $grade->grade_letter ?? '-' }}</strong></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada nilai.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Ekstrakurikuler (Relasi Many-to-Many) --}}
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Ekstrakurikuler ({{ $student->extracurriculars->count() }})</h5>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Peran</th>
                    <th>Tanggal Bergabung</th>
                </tr>
            </thead>
            <tbody>
                @forelse($student->extracurriculars as $extracurricular)
                <tr>
                    <td>{{ $extracurricular->name }}</td>
                    <td>{{ ucfirst($extracurricular->pivot->role) }}</td>
                    <td>
                        {{ $extracurricular->pivot->joined_at
                            ? \Carbon\Carbon::parse($extracurricular->pivot->joined_at)->format('d M Y')
                            : '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak mengikuti ekstrakurikuler.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection