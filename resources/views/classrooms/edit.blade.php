@extends('layouts.app')

@section('title', 'Edit Ruang Kelas')

@section('content')
<h2>Edit Ruangan: {{ $classroom->name }}</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('classrooms.update', $classroom) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Ruangan <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name" name="name" value="{{ old('name', $classroom->name) }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="building" class="form-label">Gedung <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('building') is-invalid @enderror"
                    id="building" name="building" value="{{ old('building', $classroom->building) }}" required>
                @error('building')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="capacity" class="form-label">Kapasitas <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('capacity') is-invalid @enderror"
                    id="capacity" name="capacity" value="{{ old('capacity', $classroom->capacity) }}" min="1" required>
                @error('capacity')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ route('classrooms.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection