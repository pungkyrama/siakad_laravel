@extends('layouts.app')

@section('title', 'Tambah Tag')

@section('content')
<h2>Tambah Tag Baru</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('tags.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Tag <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                    id="slug" name="slug" value="{{ old('slug') }}">
                <div class="form-text">Kosongkan untuk dibuat otomatis dari nama tag (contoh: "Basis Data" &rarr; <code>basis-data</code>).</div>
                @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('tags.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection