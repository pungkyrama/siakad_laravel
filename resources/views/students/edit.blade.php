@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<h2>Edit Mahasiswa: {{ $student->user->name }}</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('students.update', $student) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="user_id" class="form-label">Akun User <span class="text-danger">*</span></label>
                <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $student->user_id) == $user->id ? 'selected' : '' }}>
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
                    <option value="{{ $department->id }}" {{ old('department_id', $student->department_id) == $department->id ? 'selected' : '' }}>
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
                        id="nim" name="nim" value="{{ old('nim', $student->nim) }}" maxlength="20" required>
                    @error('nim')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('semester') is-invalid @enderror"
                        id="semester" name="semester" value="{{ old('semester', $student->semester) }}" min="1" max="14" required>
                    @error('semester')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Many-to-Many: Ekstrakurikuler (Checkbox) - dengan pre-selected --}}
            <div class="mb-3">
                <label class="form-label">Ekstrakurikuler yang Diikuti</label>
                <div class="row">
                    @foreach($extracurriculars as $extracurricular)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="extracurriculars[]"
                                value="{{ $extracurricular->id }}" id="extracurricular{{ $extracurricular->id }}"
                                {{ in_array($extracurricular->id, old('extracurriculars', $student->extracurriculars->pluck('id')->toArray())) ? 'checked' : '' }}>
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
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection