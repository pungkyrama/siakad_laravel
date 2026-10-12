@extends('layouts.app')

@section('title', 'Tambah Ekstrakurikuler')

@section('content')
<h2>Tambah Ekstrakurikuler Baru</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('extracurriculars.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Ekstrakurikuler <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('description') is-invalid @enderror"
                    id="description" name="description" rows="3">{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="max_members" class="form-label">Kuota Anggota <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('max_members') is-invalid @enderror"
                    id="max_members" name="max_members" value="{{ old('max_members', 50) }}" min="1" required>
                @error('max_members')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('extracurriculars.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection