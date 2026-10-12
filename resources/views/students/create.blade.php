@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
<h2>Tambah Mahasiswa Baru</h2>

<div class="card">
    <div class="card-body">
        @if($users->isEmpty())
        <div class="alert alert-warning">
            Tidak ada user yang tersedia. Buat akun user baru terlebih dahulu di menu
            <a href="{{ route('users.create') }}">Users</a>.
        </div>
        @endif

        <form action="{{ route('students.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="user_id" class="form-label">Akun User <span class="text-danger">*</span></label>
                <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                    @endforeach
                </select>
                <div class="form-text">Hanya user yang belum terdaftar sebagai dosen/mahasiswa yang ditampilkan.</div>
                @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="department_id" class="form-label">Jurusan <span class="text-danger">*</span></label>
                <select class="form-select @error('department_id') is-invalid @enderror" id="department_id" name="department_id" required>
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                    @endforeach
                </select>
                @error('department_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nim') is-invalid @enderror"
                        id="nim" name="nim" value="{{ old('nim') }}" maxlength="20" required>
                    @error('nim')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('semester') is-invalid @enderror"
                        id="semester" name="semester" value="{{ old('semester', 1) }}" min="1" max="14" required>
                    @error('semester')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Many-to-Many: Ekstrakurikuler (Checkbox) --}}
            <div class="mb-3">
                <label class="form-label">Ekstrakurikuler yang Diikuti</label>
                <div class="row">
                    @foreach($extracurriculars as $extracurricular)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="extracurriculars[]"
                                value="{{ $extracurricular->id }}" id="extracurricular{{ $extracurricular->id }}"
                                {{ in_array($extracurricular->id, old('extracurriculars', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="extracurricular{{ $extracurricular->id }}">
                                {{ $extracurricular->name }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
                @error('extracurriculars.*')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection