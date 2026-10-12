@extends('layouts.app')

@section('title', 'Tambah Jadwal')

@section('content')
<h2>Tambah Jadwal Baru</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('schedules.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="course_id" class="form-label">Mata Kuliah <span class="text-danger">*</span></label>
                <select class="form-select @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                        {{ $course->code }} - {{ $course->name }}
                    </option>
                    @endforeach
                </select>
                @error('course_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="teacher_id" class="form-label">Dosen <span class="text-danger">*</span></label>
                <select class="form-select @error('teacher_id') is-invalid @enderror" id="teacher_id" name="teacher_id" required>
                    <option value="">-- Pilih Dosen --</option>
                    @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->user->name }}
                    </option>
                    @endforeach
                </select>
                @error('teacher_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="classroom_id" class="form-label">Ruangan <span class="text-danger">*</span></label>
                <select class="form-select @error('classroom_id') is-invalid @enderror" id="classroom_id" name="classroom_id" required>
                    <option value="">-- Pilih Ruangan --</option>
                    @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}" {{ old('classroom_id') == $classroom->id ? 'selected' : '' }}>
                        {{ $classroom->name }} - {{ $classroom->building }} (kapasitas {{ $classroom->capacity }})
                    </option>
                    @endforeach
                </select>
                @error('classroom_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="day" class="form-label">Hari <span class="text-danger">*</span></label>
                    <select class="form-select @error('day') is-invalid @enderror" id="day" name="day" required>
                        <option value="">-- Pilih Hari --</option>
                        @foreach($days as $day)
                        <option value="{{ $day }}" {{ old('day') === $day ? 'selected' : '' }}>{{ $day }}</option>
                        @endforeach
                    </select>
                    @error('day')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="start_time" class="form-label">Jam Mulai <span class="text-danger">*</span></label>
                    <input type="time" class="form-control @error('start_time') is-invalid @enderror"
                        id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                    @error('start_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="end_time" class="form-label">Jam Selesai <span class="text-danger">*</span></label>
                    <input type="time" class="form-control @error('end_time') is-invalid @enderror"
                        id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                    @error('end_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('schedules.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection