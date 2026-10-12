@extends('layouts.app')

@section('title', 'Edit Ekstrakurikuler')

@section('content')
<h2>Edit Ekstrakurikuler: {{ $extracurricular->name }}</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('extracurriculars.update', $extracurricular) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Ekstrakurikuler <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name" name="name" value="{{ old('name', $extracurricular->name) }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('description') is-invalid @enderror"
                    id="description" name="description" rows="3">{{ old('description', $extracurricular->description) }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="max_members" class="form-label">Kuota Anggota <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('max_members') is-invalid @enderror"
                    id="max_members" name="max_members" value="{{ old('max_members', $extracurricular->max_members) }}" min="1" required>
                <div class="form-text">Tidak boleh lebih kecil dari jumlah anggota saat ini.</div>
                @error('max_members')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ route('extracurriculars.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection