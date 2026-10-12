@extends('layouts.app')

@section('title', 'Edit Dosen')

@section('content')
<h2>Edit Dosen: {{ $teacher->user->name }}</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('teachers.update', $teacher) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="user_id" class="form-label">Akun User <span class="text-danger">*</span></label>
                <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $teacher->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                    @endforeach
                </select>
                @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="department_id" class="form-label">Jurusan <span class="text-danger">*</span></label>
                <select class="form-select @error('department_id') is-invalid @enderror" id="department_id" name="department_id" required>
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id', $teacher->department_id) == $department->id ? 'selected' : '' }}>
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
                    id="nip" name="nip" value="{{ old('nip', $teacher->nip) }}" maxlength="30" required>
                @error('nip')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="specialization" class="form-label">Spesialisasi</label>
                <input type="text" class="form-control @error('specialization') is-invalid @enderror"
                    id="specialization" name="specialization" value="{{ old('specialization', $teacher->specialization) }}">
                @error('specialization')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection