@extends('layouts.app')

@section('title', 'Tambah Dosen')

@section('content')
<h2>Tambah Dosen Baru</h2>

<div class="card">
    <div class="card-body">
        @if($users->isEmpty())
        <div class="alert alert-warning">
            Tidak ada user yang tersedia. Buat akun user baru terlebih dahulu di menu
            <a href="{{ route('users.create') }}">Users</a>.
        </div>
        @endif

        <form action="{{ route('teachers.store') }}" method="POST">
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

            <div class="mb-3">
                <label for="nip" class="form-label">NIP <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nip') is-invalid @enderror"
                    id="nip" name="nip" value="{{ old('nip') }}" maxlength="30" required>
                @error('nip')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="specialization" class="form-label">Spesialisasi</label>
                <input type="text" class="form-control @error('specialization') is-invalid @enderror"
                    id="specialization" name="specialization" value="{{ old('specialization') }}">
                @error('specialization')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection